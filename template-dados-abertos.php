<?php
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

  /*$report = array(
    "dispensas-e-inexibilidade" => 
      array(
        "columns" => array( "Número", "Modalidade", "Processo", "Abertura", "Objeto", "Base Legal", "Situação", "Valor" ),
        "fields" => array( "numero", "modalidade", "processo", "abertura", "objeto", "base_legal", "situacao", "valor_homologado" ),
        "url" => "http://saofelixdeminas-mg.portaltp.com.br/api/transparencia.asmx/json_dispensas_inexigibilidades"
    ) ,
    "licitacoes" => 
      array(
        "columns" => array( "Número", "Modalidade", "Processo", "Abertura", "Objeto", "Situação", "Valor" ),
        "fields" => array( "numero", "modalidade", "processo", "abertura", "objeto", "situacao", "valor_homologado" ),
        "url" => "http://saofelixdeminas-mg.portaltp.com.br/api/transparencia.asmx/json_licitacoes"
    ) ,
    "contratos-e-aditivos" => 
      array(
        "columns" => array( "Contrato", "Processo", "Objeto", "Favorecido", "Documento", "Situação", "Valor" ),
        "fields" => array( "contrato", "processo", "objeto", "nome_favorecido", "documento_favorecido", "situacao", "valor" ),
        "url" => "http://saofelixdeminas-mg.portaltp.com.br/api/transparencia.asmx/json_contratos"
    ) ,
    "termos-de-compromisso-atas" => 
      array(
        "columns" => array( "Contrato", "Processo", "Assinatura", "Categoria", "CPF/CNPJ", "Favorecido", "Objeto", "Situação", "Valor" ),
        "fields" => array( "contrato", "processo", "assinatura", "categoria", "documento_favorecido", "nome_favorecido", "objeto", "valor" ),
        "url" => "http://saofelixdeminas-mg.portaltp.com.br/api/transparencia.asmx/json_atas"
    ) ,
    "ordem-de-compras" => 
      array(
        "columns" => array( "Número", "Secretaria/Órgão", "Aquisição", "Documento", "Fornecedor", "Valor" ),
        "fields" => array( "numero", "unidade_gestora", "data_ordem", "documento_favorecido", "nome_favorecido", "valor" ),
        "url" => "http://saofelixdeminas-mg.portaltp.com.br/api/transparencia.asmx/json_ordemcompras"
    ) ,
    "entrada-de-estoque" => 
      array(
        "columns" => array( "Almoxarifado", "Entrada", "Nota Fiscal", "Emissão", "Fornecedor", "Documento", "Valor" ),
        "fields" => array( "", "", "", "", "", "", "" ),
        "url" => "http://saofelixdeminas-mg.portaltp.com.br/api/transparencia.asmx/json_materiais_entradas"
    ) ,
    "saída-de-estoque" => 
      array(
        "columns" => array( "Almoxarifado", "Saída", "Requisição", "Requisitante", "Valor" ),
        "fields" => array( "", "", "", "", "" ),
        "url" => "http://saofelixdeminas-mg.portaltp.com.br/api/transparencia.asmx/json_materiais_saidas"
    ) ,
    "bens-consolidados" => 
      array(
        "columns" => array( "Data", "Categoria", "Tipo", "Controle", "Especificação", "Descrição", "Localização", "Valor" ),
        "fields" => array( "", "", "", "", "", "", "", "" ),
        "url" => "http://saofelixdeminas-mg.portaltp.com.br/api/transparencia.asmx/json_bens_consolidado"
    ) ,
    "bens-moveis" => 
      array(
        "columns" => array( "Data", "Tipo", "Motivo", "Identificação", "Categoria", "Bem", "Descrição", "Localização", "Valor" ),
        "fields" => array( "", "", "", "", "", "", "", "", "" ),
        "url" => "http://saofelixdeminas-mg.portaltp.com.br/api/transparencia.asmx/json_bens_moveis"
    ) ,
    "bens-imoveis" => 
      array(
        "columns" => array( "Data", "Bem", "identificação", "Descrição", "Situação", "Valor" ),
        "fields" => array( "", "", "", "", "", "" ),
        "url" => "http://saofelixdeminas-mg.portaltp.com.br/api/transparencia.asmx/json_bens_imoveis"
    ) ,
    "frota" => 
      array(
        "columns" => array( "Propriedade", "Fabricação", "Modelo", "Marca", "Modelo", "Cor", "Placa", "Destinação", "Localização" ),
        "fields" => array( "propriedade", "ano_fabricacao", "ano_modelo", "marca", "modelo", "cor", "placa", "situacao", "localizacao" ),
        "url" => "http://saofelixdeminas-mg.portaltp.com.br/api/transparencia.asmx/json_frota_veiculos"
    ) ,
    "orcamento-das-receitas" => 
      array(
        "columns" => array( "Categoria", "Origem", "Espécie", "Rubrica", "Alínea", "Subalínea", "Fonte de Recurso", "Valor Previsto" ),
        "fields" => array( "categoria", "origem", "especie", "rubrica", "alinea", "subalinea", "fonte_recurso", "valor" ),
        "url" => "http://saofelixdeminas-mg.portaltp.com.br/api/transparencia.asmx/json_orcamento_receitas"
    ) ,
    "receita-realizada" => 
      array(
        "columns" => array( "Data", "Fonte de Recurso", "Categoria", "Origem", "Espécie", "Rubrica", "Alínea", "Subalínea", "Previsto", "Realizado" ),
        "fields" => array( "data", "fonte_recurso", "categoria", "origem", "especie", "rubrica", "alinea", "subalinea", "valor_previsto", "valor_realizado" ),
        "url" => "http://saofelixdeminas-mg.portaltp.com.br/api/transparencia.asmx/json_execucao_receitas"
    ) ,
    "orcamento-das-despesas" => 
      array(
        "columns" => array( "Função", "Subfunção", "Programa", "Atividade/Projeto", "Fonte de Recurso", "Grupo da Despesa", "Elemento da Despesa", "Valor" ),
        "fields" => array( "funcao", "subfuncao", "programa", "atividade", "fonte_recurso", "grupo_despesa", "elemento_despesa", "valor" ),
        "url" => "http://saofelixdeminas-mg.portaltp.com.br/api/transparencia.asmx/json_orcamento_despesas"
    ) ,
    "empenhos-e-favorecidos" => 
      array(
        "columns" => array( "Data", "Processo", "Empenho", "Histórico", "Favorecido", "Documento", "Valor" ),
        "fields" => array( "data", "", "empenho", "", "nome_favorecido", "documento_favorecido", "valor" ),
        "url" => "http://saofelixdeminas-mg.portaltp.com.br/api/transparencia.asmx/json_empenhos"
    ) ,
    "liquidacoes-e-favorecidos" => 
      array(
        "columns" => array( "Data", "Processo", "Liquidação", "Histórico", "Favorecido", "Documento", "Valor" ),
        "fields" => array( "data", "", "liquidacao", "", "nome_favorecido", "documento_favorecido", "valor" ),
        "url" => "http://saofelixdeminas-mg.portaltp.com.br/api/transparencia.asmx/json_liquidacoes"
    ) ,
    "pagamentos-e-favorecidos" => 
      array(
        "columns" => array( "Data", "Processo", "Pagamento", "Histórico", "Favorecido", "Documento", "Valor" ),
        "fields" => array( "data", "", "pagamento", "", "nome_favorecido", "documento_favorecido", "valor" ),
        "url" => "http://saofelixdeminas-mg.portaltp.com.br/api/transparencia.asmx/json_pagamentos"
    ) ,
    "despesas-com-diarias" => 
      array(
        "columns" => array( "Data", "Processo", "Pagamento", "Histórico", "Favorecido", "Documento", "Valor" ),
        "fields" => array( "data", "", "pagamento", "", "nome_favorecido", "documento_favorecido", "valor" ),
        "url" => "http://saofelixdeminas-mg.portaltp.com.br/api/transparencia.asmx/json_diarias"
    ) ,
    "despesas-com-passagens" => 
      array(
        "columns" => array( "Data", "Processo", "Pagamento", "Histórico", "Favorecido", "Documento", "Valor" ),
        "fields" => array( "", "", "", "", "", "", "" ),
        "url" => "http://saofelixdeminas-mg.portaltp.com.br/api/transparencia.asmx/json_passagens"
    ) ,
    "despesas-com-obras" => 
      array(
        "columns" => array( "Data", "Processo", "Pagamento", "Histórico", "Favorecido", "Documento", "Valor" ),
        "fields" => array( "data", "", "pagamento", "", "nome_favorecido", "documento_favorecido", "valor" ),
        "url" => "http://saofelixdeminas-mg.portaltp.com.br/api/transparencia.asmx/json_obras"
    ) ,
    "tranferencias-cedidas" => 
      array(
        "columns" => array( "Data", "Beneficiário", "Documento", "Objeto", "Vigência Inicial", "Vigêencia Final", "Valor a Ceder", "Valor Contrapartida" ),
        "fields" => array( "", "", "", "", "", "", "" ),
        "url" => "http://saofelixdeminas-mg.portaltp.com.br/api/transparencia.asmx/json_convenios_firmados"
    ) ,
    "transferencias-recebidas" => 
      array(
        "columns" => array( "Data", "Beneficiário", "Documento", "Objeto", "Vigência Inicial", "Vigêencia Final", "Valor a Ceder", "Valor Contrapartida" ),
        "fields" => array( "", "", "", "", "", "", "" ),
        "url" => "http://saofelixdeminas-mg.portaltp.com.br/api/transparencia.asmx/json_convenios_firmados"
    ) ,
    "transferencias-extraorcamentarias" => 
      array(
        "columns" => array( "Data", "Tipo", "Origem", "Número", "Conta Contábil", "Fonte Recurso", "Documento", "Favorecido", "Receita", "Despesa" ),
        "fields" => array( "data", "tipo", "origem", "numero", "conta_contabil", "fonte_recurso", "documento_favorecido", "nome_favorecido", "valor_receita", "valor_despesa" ),
        "url" => "http://saofelixdeminas-mg.portaltp.com.br/api/transparencia.asmx/json_transf_extraorcamentarias"
    ) ,
    "transferencias-intraorcamentarias" => 
      array(
        "columns" => array( "Data", "Tipo", "Origem", "Número", "Conta Contábil", "Fonte Recurso", "Documento", "Favorecido", "Receita", "Despesa" ),
        "fields" => array( "data", "tipo", "origem", "numero", "conta_contabil", "fonte_recurso", "documento_favorecido", "nome_favorecido", "valor_receita", "valor_despesa" ),
        "url" => "http://saofelixdeminas-mg.portaltp.com.br/api/transparencia.asmx/json_transf_intraorcamentarias"
    ) ,
    "servidores" => 
      array(
        "columns" => array( "Matrícula", "Nome", "Documento", "Vínculo", "Cargo", "Admissão", "Demissão", "Situação" ),
        "fields" => array( "matricula", "nome", "documento", "regime", "cargo", "data_admissao", "data_demissao", "situacao" ),
        "url" => "http://saofelixdeminas-mg.portaltp.com.br/api/transparencia.asmx/json_servidores"
    ) ,
    "plano-de-cargos-e-salarios" => 
      array(
        "columns" => array( "Matrícula", "Nome", "Documento", "Regime", "Admissão", "Demissão", "Situação" ),
        "fields" => array( "", "", "", "", "", "", "" ),
        "url" => "http://saofelixdeminas-mg.portaltp.com.br/api/transparencia.asmx/json_plano_carreiras"
    ) ,
    "cargos-e-vagas" => 
      array(
        "columns" => array( "Cargo", "Vagas Disponíveis", "Vagas Ocupadas" ),
        "fields" => array( "", "", "" ),
        "url" => "http://saofelixdeminas-mg.portaltp.com.br/api/transparencia.asmx/json_vagas_cargos"
    ) ,
    "atos-dos-cargos" => 
      array(
        "columns" => array( "Mês", "Entidade", "Exercício", "Cargo", "Nº Ato", "Ano do Ato", "Resumo Ementa", "Ementa", "Vigência" ),
        "fields" => array( "", "", "", "", "", "", "", "", "" ),
        "url" => "http://saofelixdeminas-mg.portaltp.com.br/api/transparencia.asmx/json_atos_cargos"
    ) ,
    "cargos-comissionados" => 
      array(
        "columns" => array( "Matrícula", "Nome do Servidor", "Documento", "Cargo", "Admissão", "Demissão", "Situação" ),
        "fields" => array( "", "", "", "", "", "", "" ),
        "url" => "http://saofelixdeminas-mg.portaltp.com.br/api/transparencia.asmx/json_cargos_confianca"
    ) ,
  );*/

  $report = file_get_contents( dirname(__FILE__) . '/dados-aberto.json' );
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
        <table class="table" id="dados-abertos-table">
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
