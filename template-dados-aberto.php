<?php
  /**
   * Template Name: Dados Aberto
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

  $report = array(
    "dispensas-e-inexibilidade" => 
      array(
        "columns" => array( "Número", "Modalidade", "Processo", "Abertura", "Objeto", "Base Legal", "Situação", "Valor" ),
        "fields" => array( "numero", "modalidade", "processo", "abertura", "objeto", "base_legal", "situacao", "valor_homologado"),
        "url" => "http://saofelixdeminas-mg.portaltp.com.br/api/transparencia.asmx/json_dispensas_inexigibilidades"
    ) ,
  );

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

  $current_post_type = get_post_type( $post->ID );
  $exclude_post_type = array(
    'zn_layout',
    'znpb_template_mngr',
    'attachment',
    'product',
    'post',
  );

  // Check to see on what type of page we are on
  $sidebar_layout = 'single_sidebar';
  if ( ! in_array( $current_post_type, $exclude_post_type ) ) {
    $sidebar_layout = $current_post_type . '_sidebar';
  }

  // Check to see if the page has a sidebar or not
  $main_class = zn_get_sidebar_class($sidebar_layout);
  if( strpos( $main_class , 'right_sidebar' ) !== false || strpos( $main_class , 'left_sidebar' ) !== false ) { $zn_config['sidebar'] = true; } else { $zn_config['sidebar'] = false; }
  $sidebar_size = zget_option( 'sidebar_size', 'unlimited_sidebars', false, 3 );
  $content_size = 12 - (int)$sidebar_size;
  $zn_config['size'] = $zn_config['sidebar'] ? 'col-sm-8 col-md-'.$content_size : 'col-sm-12';
  ?>

  <nav>
  <?php
    wp_nav_menu( array( 
        'theme_location' => 'dados-aberto', 
        'container_id' => 'dados-aberto-menu',
        'walker' => new CSS_Menu_Walker_Dados_Aberto() 
        ) 
      ); 
  ?>
  </nav>

  <main id="site-content" role="main">

    <div class="container">
      <div class="row dados-aberto-filter">
          <form action="">
            <div class="row">
              <div class="col-md-4">
                <input class="form-control" type="number" name="ano" id="year" min="1900" max="2099" value="<?php echo $year; ?>">
              </div>
              <div class="col-md-4">
                <select class="form-control" name="mes" id="month">
                  <?php foreach ($months as $key => $value) :?>
                    <option value="<?php echo $key; ?>" <?php if ($month == $key) echo 'selected'; ?>><?php echo $value; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-md-4">
                <button type="submit" class="btn btn-light mb-2">Aplicar</button>
              </div>
            </div>
          </form>
      </div>
      <div class="row">
        <table class="table" id="dados-aberto-table">
        <thead>
          <tr>
            <?php foreach ($report[ $reportType ][ 'columns' ] as $value) : ?> 
              <th><?php echo $value; ?></th>
            <?php endforeach; ?>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($result as $key => $value) : ?> 
            <tr>
              <?php foreach ($report[ $reportType ][ 'fields' ] as $name) : ?> 
                <td><?php echo $value[ $name ]; ?></td>
              <?php endforeach; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
        </table>
      </div>
    </div>

  </main><!-- #site-content -->

  <?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

  <?php get_footer(); ?>

        </tbody>
        </table>
      </div>
    </div>

  </main><!-- #site-content -->

  <?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

  <?php get_footer(); ?>
