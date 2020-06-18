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
                      $v = str_replace( 'T00:00:00', '', $value[ $name ] );
                      if ( $report[ $reportType ][ 'types' ][ $key2 ] == 'c' ) :
                        echo 'R$ ' . number_format( $v, 2, ',', '.' );
                      elseif ( $report[ $reportType ][ 'types' ][ $key2 ] == 'd' ) :
                        $date = date_create( $v );
                        echo date_format( $date, 'd/m/Y' );
                      else :
                        echo $v;
                      endif;
                    ?>
                  </td>
                <?php endforeach; ?>
              </tr>
            <?php endforeach; ?>
  
          </tbody>
        </table>
        <nav id="dados-abertos-pager"></nav>
      </div>
    </div>

  </main><!-- #site-content -->

  <?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

  <?php get_footer(); ?>
