<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

  /**
   * Template Name: Dados Abertos
   * Template Post Type: page
   *
   */

  $months = array(
    "1" => "Janeiro",
    "2" => "Fevereiro",
    "3" => "Março",
    "4" => "Abril",
    "5" => "Maio",
    "6" => "Junho",
    "7" => "Julho",
    "8" => "Agosto",
    "9" => "Setembro",
    "10" => "Outubro",
    "11" => "Novembro",
    "12" => "Dezembro",
  ); 

  $report = file_get_contents( dirname(__FILE__) . '/dados-abertos.json' );
  $report = json_decode( $report, true );

  $reportType = get_field_object( 'report_type', get_the_ID() )[ 'value' ];

  $year = date('Y');
  if ( isset( $_GET[ 'ano' ])) 
    $year = $_GET[ 'ano' ];

  $month = date('m');  
  if ( isset( $_GET[ 'mes' ])) 
    $month = $_GET[ 'mes' ];

  $url = $report[ $reportType ][ 'url' ];
  $url .= "?ano=$year&mes=$month";

  $xmlString = file_get_contents( $url );
  $xml = simplexml_load_string( $xmlString );
  $result = json_decode(  $xml, true );

  while( count( $result ) == 0 && !isset( $_GET[ 'ano' ] ) && !isset( $_GET[ 'mes' ] )) {
    $month--;
    if ( $month == 0 ) {
      $month = 12;
      $year--;
    }
    $url = $report[ $reportType ][ 'url' ];
    $url .= "?ano=$year&mes=$month";
    $xmlString = file_get_contents( $url );
    $xml = simplexml_load_string( $xmlString );
    $result = json_decode(  $xml, true );
    if ( $year == 2017 && $month == 1 ) break;
  }

  get_header();
  $args = array();
  $override_page_title = zget_option( 'zn_override_single_title', 'blog_options' );
  if( 'yes' === $override_page_title ){
    $args['title'] = zget_option( 'single_page_title', 'blog_options' );
  }

  /*** USE THE NEW HEADER FUNCTION **/
  WpkPageHelper::zn_get_subheader( $args );

  ?>

  <nav>
  <?php
    wp_nav_menu( array( 
        'theme_location' => 'dados-abertos', 
        'container_id' => 'dados-abertos-menu',
        'walker' => new CSS_Menu_Walker_Dados_Abertos() 
        ) 
      ); 
  ?>
  </nav>

  <main id="site-content" role="main">

    <div class="container">
      <div class="row dados-abertos-filter">
          <form action="">
            <div class="row">
              <?php if ( $report[ $reportType ][ 'filter' ][ 'year' ] ) :?>
              <div class="col-md-<?php echo $report[ $reportType ][ 'filter' ][ 'year' ] && $report[ $reportType ][ 'filter' ][ 'month' ] ? '4' : '6'  ?>">
                <input class="form-control" type="number" name="ano" id="year" min="1900" max="2099" value="<?php echo $year; ?>">
              </div>
              <?php endif; ?>
              <?php if ( $report[ $reportType ][ 'filter' ][ 'month' ] ) :?>
              <div class="col-md-<?php echo $report[ $reportType ][ 'filter' ][ 'year' ] && $report[ $reportType ][ 'filter' ][ 'month' ] ? '4' : '6'  ?>">
                <select class="form-control" name="mes" id="month">
                  <?php foreach ($months as $key => $value) :?>
                    <option value="<?php echo $key; ?>" <?php if ($month == $key) echo 'selected'; ?>><?php echo $value; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <?php endif; ?>
              <?php if ( $report[ $reportType ][ 'filter' ][ 'year' ] || $report[ $reportType ][ 'filter' ][ 'month' ] ) :?>
              <div class="col-md-4">
                <button type="submit" class="btn btn-light mb-2">Aplicar</button>
              </div>
              <?php endif; ?>
            </div>
          </form>
      </div>
      <div class="row">
        <table class="table table-bordered paginated" id="dados-abertos-table">
          <thead>
            <tr>
              <?php foreach ($report[ $reportType ][ 'columns' ] as $value) : ?> 
                <th><?php echo $value; ?></th>
              <?php endforeach; ?>
            </tr>
            <tr>
              <?php foreach ($report[ $reportType ][ 'columns' ] as $value) : ?> 
                <th>
                  <div class="input-group">
                    <input class="form-control dados-abertos-filter-input datatable-filter datatable-input-text" type="text" name="<?php echo sanitize_title( $value ); ?>">
                    <span class="input-group-addon">
                      <i class="fa fa-filter"  aria-hidden='true'></i>
                    </span>
                  </div>
                </th>
              <?php endforeach; ?>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($result as $key => $value) : ?> 
              <tr>
                <?php foreach ($report[ $reportType ][ 'fields' ] as $key2 => $name) : ?> 
                  <td>
                    <?php 
                      $v = $value[ $name ];
                      switch ( $report[ $reportType ][ 'types' ][ $key2 ][0] ) :
                        case 'c':
                          echo 'R$ ' . number_format( $v, 2, ',', '.' );
                          break;
                        case 'd':
                          $v = str_replace( 'T00:00:00', '', $v );
                          $v = str_replace( ' 00:00:00', '', $v );
                          if ( $v == '' ) break;
                          $date = date_create( $v );
                          if ( $date )
                            echo date_format( $date, 'd/m/Y' ); 
                          else 
                            echo $v;
                          break;
                        case 'i':
                          $width = substr( $report[ $reportType ][ 'types' ][ $key2 ], 3 );
                          $padded = str_pad((string)$v, $width, "0", STR_PAD_LEFT); 
                          echo $padded;
                          break;
                        default:
                          echo $v;
                          break;
                      endswitch;
                    ?>
                  </td>
                <?php endforeach; ?>
              </tr>
            <?php endforeach; ?>
          </tbody>
          <?php if( $report[ $reportType ][ 'footer' ] ) : ?>
            <tfoot>
              <tr>
                <?php foreach ( $report[ $reportType ][ 'columns' ] as $key => $value ) : ?> 
                  <td><strong>
                    <?php foreach( $report[ $reportType ][ 'footer' ] as $value2 ) :
                      if ( $value2['index'] == $key ) :
                        switch ( $value2['type'] ) :
                          case 'COUNT_ROW':
                            echo sprintf( '%s %d %s',  $value2[ 'prefix' ], count( $result ), $value2[ 'posfix' ] );
                            break;
                          case 'SUM_COLUMN':
                            $sum = array_sum( array_column( $result, $report[ $reportType ][ 'fields' ][ $key ] ) );
                            echo sprintf( '%s R$ %s %s',  $value2[ 'prefix' ], number_format( $sum, 2, ',', '.' ), $value2[ 'posfix' ] );
                        endswitch;
                      endif;
                    endforeach; ?>
                  </strong></td>
                <?php endforeach; ?>
              </tr>
            </tfoot>
          <?php endif; ?>
        </table>
        <div class="row">
          <div class="col-md-8">
            <nav id="dados-abertos-pager"></nav>
          </div>
          <div class="col-md-4 form-inline" id="dados-abertos-page-length">
            <div class="form-group row">
              <label for="page_length" class="col-sm-8 col-form-label">Tamanho da Página: </label>
              <div class="col-sm-2">
                <select class="form-control" name="page_length" id="page_length">
                  <option value="10">10</option>
                  <option value="20">20</option>
                  <option value="30">30</option>
                  <option value="<?php echo count( $result ); ?>">Tudo</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </main><!-- #site-content -->

  <?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

  <?php get_footer(); ?>
