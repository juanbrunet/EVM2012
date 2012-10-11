<?php

// define themes
$uds_themes = array(
	'contrast' => array(
		'label' => 'Default',
		'file' => null
	),
	'dark' => array(
		'label' => 'Dark',
		'file' => 'theme-dark.css'
	)
);

// define backgrounds	
$uds_backgrounds = array(
	'none' => array(
		'label' => 'Default',
		'file' => null
	),
	'carbon' => array(
		'label' => 'Carbon',
		'file' => 'theme-bg-carbon.css'
	),
	'darkstars' => array(
		'label' => 'Dark Stars',
		'file' => 'theme-bg-darkstars.css'
	),
	'wood' => array(
		'label' => 'Wood',
		'file' => 'theme-bg-wood.css'
	),
	'darkwood' => array(
		'label' => 'Dark Wood',
		'file' => 'theme-bg-darkwood.css'
	),
	'vintage' => array(
		'label' => 'Vintage',
		'file' => 'theme-bg-vintage.css'
	),
	'stripes-vertical' => array(
		'label' => 'Vertical stripes',
		'file' => 'theme-bg-stripes-vertical.css'
	),
	'blue' => array(
		'label' => 'Blue',
		'file' => 'theme-bg-blue.css'
	),
	'brown' => array(
		'label' => 'Brown',
		'file' => 'theme-bg-brown.css'
	),
	'purple' => array(
		'label' => 'Purple',
		'file' => 'theme-bg-purple.css'
	),
	'red' => array(
		'label' => 'Red',
		'file' => 'theme-bg-red.css'
	)
);

$uds_general_options = array(
	'uds-heading-type' => array(
		'label' => 'Tipo de cabecera',
		'description' => 'La cabecera puede ser texto o foto',
		'default' => 'text',
		'type' => 'alternate',
		'options' => array(
			'text' => 'Texo',
			'image' => 'Imagen'
		),
		'alternates' => array (
			'text' => array(
				'uds-heading' => array(
					'label' => 'Cabecera',
					'description' => 'Texto cabecera',
					'default' => UDS_TEMPLATE_NAME,
					'type' => 'string'
				),
				'uds-subheading' => array(
					'label' => 'Subcabecera',
					'description' => 'Texto subcabecera',
					'default' => '',
					'type' => 'string'
				)
			),
			'image' => array(
				'uds-logo' => array(
					'label' => 'Logo',
					'description' => 'Logo cabecera',
					'default' => get_template_directory_uri() . '/images/logo.png',
					'type' => 'image'
				)
			)
		)
	),
	'uds-theme' => array(
		'label' => 'Tema',
		'description' => 'Se mostrará en FrontEnd',
		'default' => 'default',
		'type' => 'select',
		'options' => array(
			'default' => 'Default'
		)
	),
	'uds-blog-post-length' => array(
		'label' => 'Contenido del blog',
		'description' => 'Auto mostrará solo extractos cuando estén disponibles, de lo contrario mostrará todo el contenido',
		'default' => 'auto',
		'type' => 'select',
		'options' => array(
			'auto' => 'Auto',
			'excerpt' => 'Sólo extractos',
			'content' => 'Todo el contenido'
		)
	),
	'uds-show-authorbox' => array(
		'label' => 'Mostrar autor',
		'description' => 'Pequeña información acerca del autor debjo de los posts',
		'default' => 'on',
		'type' => 'switch'
	),
	'uds-footer-config' => array(
		'label' => 'Configuración pie de página',
		'description' => 'Configuración de columnas',
		'default' => '4',
		'type' => 'select',
		'options' => array(
			'2' => '2 Columnas',
			'3' => '3 Columnas',
			'4' => '4 Columnas',
			'5' => '5 Columnas'
		)
	),
	'uds-copyright' => array(
		'label' => 'Copyright',
		'description' => '',
		'default' => 'EVM',
		'type' => 'string'
	),
	'uds-breadcrumb-separator' => array(
		'label' => 'Breadcrumbs(Separador)',
		'description' => '',
		'default' => '»',
		'type' => 'string'
	),
	'uds-favicon' => array(
		'label' => 'Favicon',
		'description' => '',
		'default' => get_template_directory_uri() . '/images/favicon.ico',
		'type' => 'image'
	),
	'uds-show-tagline' => array(
		'label' => 'Mostrar Tagline',
		'description' => 'Habilitar/Desabilitar Tagline',
		'default' => '',
		'type' => 'opcional',
		'optionals' => array(
			'uds-tagline-button-image' => array(
				'label' => 'Tagline botón',
				'description' => '',
				'default' => get_template_directory_uri() . '/images/btn-tour.png',
				'type' => 'image'
			),
			'uds-tagline-text' => array(
				'label' => 'Tagline texto',
				'description' => 'Texto principal',
				'default' => '',
				'type' => 'string'
			),
			'uds-tagline-button-link' => array(
				'label' => 'Tagline link',
				'description' => '',
				'default' => '',
				'type' => 'string'
			)
		)
	),
	'uds-ga' => array(
		'label' => 'Google Analytics',
		'description' => 'Habilitar/Desabilitar soporte Google Analytics',
		'default' => '',
		'type' => 'optional',
		'optionals' => array(
			'uds-ga-tracking-code' => array(
				'label' => 'Código Tracking',
				'description' => '',
				'default' => '',
				'type' => 'string'
			),
			'uds-ga-tracking-domain' => array(
				'label' => 'Dominio Tracking',
				'description' => 'Texto Tagline',
				'default' => '',
				'type' => 'string'
			),
			'uds-google-key' => array(
				'label' => 'API Key (Para mapa)',
				'description' => 'Soporte Widget mapa',
				'default' => '',
				'type' => 'string'
			)
		)
	)
);

$uds_contact_options = array(
	'uds-cf-recipient' => array(
		'label' => 'Tú dirección de correo',
		'description' => 'Dirección de destino para el envío de correos por formularios',
		'default' => get_bloginfo('admin_email'),
		'type' => 'string'
	),
	'uds-cf-subject-prefix' => array(
		'label' => 'Prefijo asunto mail',
		'description' => 'Prefijo de los mensajes enviados',
		'default' => 'Contact form ',
		'type' => 'string'
	),
	'uds-cf-success-message' => array(
		'label' => 'Mensaje de envío',
		'description' => 'Aparecerá al  usuario cuando el mensaje se haya enviado',
		'default' => 'El mensaje se ha enviado correctamente',
		'type' => 'string'
	)
);

$uds_colors_options = array(
	'uds-use-user-colors' => array(
		'label' => 'Use user defined colors',
		'description' => 'Override theme colors with those defined here',
		'default' => '',
		'type' => 'checkbox'
	),
	'uds-color-bg' => array(
		'label' => 'Background Color',
		'description' => '',
		'default' => 'ffffff',
		'type' => 'color'
	),
	'uds-color-text' => array(
		'label' => 'Text Color',
		'description' => 'Color of all body text',
		'default' => '777777',
		'type' => 'color'
	),
	'uds-color-link' => array(
		'label' => 'Link Color',
		'description' => '',
		'default' => 'e6212e',
		'type' => 'color'
	),
	'uds-color-page-heading' => array(
		'label' => 'Page Heading Color',
		'description' => '',
		'default' => '333333',
		'type' => 'color'
	),
	'uds-color-heading' => array(
		'label' => 'Heading Color',
		'description' => '',
		'default' => '666666',
		'type' => 'color'
	),
	'uds-color-borders' => array(
		'label' => 'Border Color',
		'description' => '',
		'default' => 'cccccc',
		'type' => 'color'
	),
	'uds-color-meta' => array(
		'label' => 'Meta (Post info, date, author, etc.) Color',
		'description' => '',
		'default' => 'cccccc',
		'type' => 'color'
	),
	'uds-color-comment-heading-bg' => array(
		'label' => 'Comment Header Background Color',
		'description' => '',
		'default' => '666666',
		'type' => 'color'
	),
	'uds-color-comment-body-bg' => array(
		'label' => 'Comment Body Background Color',
		'description' => '',
		'default' => 'cccccc',
		'type' => 'color'
	),
	'uds-color-header-bg' => array(
		'label' => 'Header Background Color',
		'description' => '',
		'default' => 'efefef',
		'type' => 'color'
	),
	'uds-color-header-text' => array(
		'label' => 'Header Text Color',
		'description' => '',
		'default' => '777777',
		'type' => 'color'
	),
	'uds-color-footer-bg' => array(
		'label' => 'Footer Background Color',
		'description' => '',
		'default' => '111111',
		'type' => 'color'
	),
	'uds-color-footer-text' => array(
		'label' => 'Footer Text Color',
		'description' => '',
		'default' => 'afafaf',
		'type' => 'color'
	)
);

$uds_social_options = array(
	'uds-rss' => array(
		'label' => 'RSS URL',
		'description' => '',
		'default' => '',
		'type' => 'string'
	),
	'uds-skype' => array(
		'label' => 'Skype URL',
		'description' => '',
		'default' => '',
		'type' => 'string'
	),
	'uds-facebook' => array(
		'label' => 'Facebook URL',
		'description' => '',
		'default' => '',
		'type' => 'string'
	),
	'uds-twitter' => array(
		'label' => 'Twitter URL',
		'description' => '',
		'default' => '',
		'type' => 'string'
	),
	'uds-youtube' => array(
		'label' => 'Youtube URL',
		'description' => '',
		'default' => '',
		'type' => 'string'
	),
	'uds-flickr' => array(
		'label' => 'Slideshare URL',
		'description' => '',
		'default' => '',
		'type' => 'string'
	),
	'uds-linkedin' => array(
		'label' => 'LinkedIn URL',
		'description' => '',
		'default' => '',
		'type' => 'string'
	),
);

?>