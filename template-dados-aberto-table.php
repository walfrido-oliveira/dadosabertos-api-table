  <?php
  /**
   * Template Name: Dados Aberto
   * Template Post Type: page
   *
   */

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

  <style>
    .dados-aberto-filter {
      background-color: #337ab7; 
      padding: 10px;
      margin-top: 20px;
    }

    .dados-aberto-filter form {
      float: right;
    }

    /* start dados aberto menu   */
    #dados-aberto-menu,
    #dados-aberto-menu ul,
    #dados-aberto-menu li,
    #dados-aberto-menu a {
      border: none;
      margin: 0;
      padding: 0;
      line-height: 1;
      -webkit-box-sizing: content-box;
      -moz-box-sizing: content-box;
      box-sizing: content-box;
    }
    #dados-aberto-menu {
      height: 37px;
      display: block;
      padding: 0;
      margin: 0;
      width: auto;
    }
    #dados-aberto-menu,
    #dados-aberto-menu > ul > li > ul > li a:hover {
      background: #337ab7;
    }
    #dados-aberto-menu > ul {
      list-style: inside none;
      padding: 0;
      margin: 0;
    }
    #dados-aberto-menu > ul > li {
      list-style: inside none;
      padding: 0;
      margin: 0;
      float: left;
      display: block;
      position: relative;
    }
    #dados-aberto-menu > ul > li > a {
      outline: none;
      display: block;
      position: relative;
      padding: 12px 20px;
      text-align: center;
      text-decoration: none;
      text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.4);
      font-weight: bold;
      font-size: 13px;
      font-family: Arial, Helvetica, sans-serif;
      color: #ffffff;  
      text-transform: uppercase;
    }
    #dados-aberto-menu > ul > li > a:hover {
      background: #080808;
      color: #ffffff;
    }
    #dados-aberto-menu > ul > li:first-child > a {
      border-radius: 5px 0 0 5px;
    }
    #dados-aberto-menu > ul > li > a:after {
      content: '';
      position: absolute;
      top: -1px;
      bottom: -1px;
      right: -2px;
      z-index: 99; 
    }
    #dados-aberto-menu ul li.has-sub:hover > a:after {
    top: 0;
    bottom: 0;
  }
  #dados-aberto-menu > ul > li.has-sub > a:before {
    content: '';
    position: absolute;
    top: 18px;
    right: 6px;
    border: 5px solid transparent;
    border-top: 5px solid #ffffff;
  }
  #dados-aberto-menu > ul > li.has-sub:hover > a:before {
    top: 19px;
  }
  #dados-aberto-menu ul li.has-sub:hover > a {
    background: #3f3f3f;
    border-color: #3f3f3f;
    padding-bottom: 13px;
    padding-top: 13px;
    top: -1px;
    z-index: 999;
  }
  #dados-aberto-menu ul li.has-sub:hover > ul,
  #dados-aberto-menu ul li.has-sub:hover > div {
    display: block;
  }
  #dados-aberto-menu ul li.has-sub > a:hover {
    background: #3f3f3f;
    border-color: #3f3f3f;
  }
  #dados-aberto-menu ul li > ul,
  #dados-aberto-menu ul li > div {
    display: none;
    width: auto;
    position: absolute;
    top: 38px;
    padding: 10px 0;
    background: #3f3f3f;
    border-radius: 0 0 5px 5px;
    z-index: 999;
  }
  #dados-aberto-menu ul li > ul {
    width: 200px;
  }
  #dados-aberto-menu ul li > ul li {
    display: block;
    list-style: inside none;
    padding: 0;
    margin: 0;
    position: relative;
  }
  #dados-aberto-menu ul li > ul li a {
    outline: none;
    display: block;
    position: relative;
    margin: 0;
    padding: 8px 20px;
    font: 10pt Arial, Helvetica, sans-serif;
    color: #ffffff;
    text-decoration: none;
    text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.5);
    text-transform: uppercase;
  }
  #dados-aberto-menu ul ul a:hover {
    color: #ffffff;
  }
  #dados-aberto-menu > ul > li.has-sub > a:hover:before {
    border-top: 5px solid #ffffff;
  }
  /* end dados aberto menu */

  /*table*/
  #dados-aberto-table th {
    color: #337ab7; 
    text-transform: uppercase;
  }

  </style>

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
                <input class="form-control" type="number" name="" id="" min="1900" max="2099" value="<?php echo date('Y'); ?>">
              </div>
              <div class="col-md-4">
                <select class="form-control" name="" id="">
                  <option value="1">Janeiro</option>
                  <option value="2">Fevereiro</option>
                  <option value="3">Março</option>
                  <option value="4">Abril</option>
                  <option value="5">Maio</option>
                  <option value="6">Junho</option>
                  <option value="7">Julho</option>
                  <option value="8">Agosto</option>
                  <option value="9">Setembro</option>
                  <option value="10">Outubro</option>
                  <option value="11">Novembro</option>
                  <option value="12">Dezembro</option>
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
            <th>Número</th>
            <th>Modalidade</th>
            <th>Processo</th>
            <th>Abertura</th>
            <th>Objeto</th>
            <th>Base Legal</th>
            <th>Situação</th>
            <th>Valor</th>
          </tr>
        </thead>
        </table>
      </div>
    </div>

  </main><!-- #site-content -->

  <?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

  <?php get_footer(); ?>
