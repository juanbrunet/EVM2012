// Docu : http://wiki.moxiecode.com/index.php/TinyMCE:Create_plugin/3.x#Creating_your_own_plugins

(function() {
	// Load plugin specific language pack
	//tinymce.PluginManager.requireLangPack('udsExtensions');
	
	tinymce.create('tinymce.plugins.udsExtensions', {
		/**
		 * Initializes the plugin, this will be executed after the plugin has been created.
		 * This call is done before the editor instance has finished it's initialization so use the onInit event
		 * of the editor instance to intercept that event.
		 *
		 * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
		 * @param {string} url Absolute URL to where the plugin is located.
		 */
		init : function(ed, url) {
			// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');
			var thirds = 0;
			var fourths = 0;
			
			// Thirds
			ed.addCommand('mceThirds', function() {
				var sel = ed.selection.getContent();
				sel = '[third]' + sel + '[/third]';
				ed.selection.setContent(sel);
			});
			
			ed.addButton('udsThirds', {
				title : 'Columna un tercio',
				cmd : 'mceThirds',
				image : url + '/images/13.gif'
			});
			
			// Two thirds
			ed.addCommand('mceTwoThirds', function() {
				var sel = ed.selection.getContent();
				sel = '[two-thirds]' + sel + '[/two-thirds]';
				ed.selection.setContent(sel);
			});
			
			ed.addButton('udsTwoThirds', {
				title : 'Columna Dos Tercios',
				cmd : 'mceTwoThirds',
				image : url + '/images/23.gif'
			});
			
			// halves
			ed.addCommand('mceHalves', function() {
				var sel = ed.selection.getContent();
				sel = '[half]' + sel + '[/half]';
				ed.selection.setContent(sel);
			});
			
			ed.addButton('udsHalves', {
				title : 'Columna media',
				cmd : 'mceHalves',
				image : url + '/images/12.gif'
			});
			
			// fourths
			ed.addCommand('mceFourths', function() {
				var sel = ed.selection.getContent();
				sel = '[fourth]' + sel + '[/fourth]';
				ed.selection.setContent(sel);
			});
			
			ed.addButton('udsFourths', {
				title : 'Columna un cuarto',
				cmd : 'mceFourths',
				image : url + '/images/14.gif'
			});
			
			// three fourths
			ed.addCommand('mceThreeFourths', function() {
				var sel = ed.selection.getContent();
				sel = '[three-fourths]' + sel + '[/three-fourths]';
				ed.selection.setContent(sel);
			});
			
			ed.addButton('udsThreeFourths', {
				title : 'Columna tres cuartos',
				cmd : 'mceThreeFourths',
				image : url + '/images/34.gif'
			});
			
			// box
			ed.addCommand('mceBox', function() {
				var sel = ed.selection.getContent();
				sel = '[box]' + sel + '[/box]';
				ed.selection.setContent(sel);
			});
			
			ed.addButton('udsBox', {
				title : 'Caja de Texto',
				cmd : 'mceBox',
				image : url + '/images/box.gif'
			});
			
			// info
			ed.addCommand('mceBoxInfo', function() {
				var sel = ed.selection.getContent();
				sel = '[box type=info]' + sel + '[/box]';
				ed.selection.setContent(sel);
			});
			
			ed.addButton('udsBoxInfo', {
				title : 'Caja de texto informativo',
				cmd : 'mceBoxInfo',
				image : url + '/images/info.gif'
			});
			
			// success
			ed.addCommand('mceBoxSuccess', function() {
				var sel = ed.selection.getContent();
				sel = '[box type=success]' + sel + '[/box]';
				ed.selection.setContent(sel);
			});
			
			ed.addButton('udsBoxSuccess', {
				title : 'Caja de texto de verificación',
				cmd : 'mceBoxSuccess',
				image : url + '/images/success.gif'
			});
			
			// warn
			ed.addCommand('mceBoxWarn', function() {
				var sel = ed.selection.getContent();
				sel = '[box type=warn]' + sel + '[/box]';
				ed.selection.setContent(sel);
			});
			
			ed.addButton('udsBoxWarn', {
				title : 'Caja de Texto de advertencia',
				cmd : 'mceBoxWarn',
				image : url + '/images/warn.gif'
			});
			
			// error
			ed.addCommand('mceBoxError', function() {
				var sel = ed.selection.getContent();
				sel = '[box type=error]' + sel + '[/box]';
				ed.selection.setContent(sel);
			});
			
			ed.addButton('udsBoxError', {
				title : 'Caja de Texto de error',
				cmd : 'mceBoxError',
				image : url + '/images/error.gif'
			});
			
			// list style
			ed.addCommand('mceListStyle', function() {
				var sel = ed.selection.getContent();
				sel = '[list]' + sel + '[/list]';
				ed.selection.setContent(sel);
			});
			
			ed.addButton('udsListStyle', {
				title : 'Lista con estilo',
				cmd : 'mceListStyle',
				image : url + '/images/list-style.gif'
			});
			
			// list style checklist
			ed.addCommand('mceListStyleCheck', function() {
				var sel = ed.selection.getContent();
				sel = '[list type=check]' + sel + '[/list]';
				ed.selection.setContent(sel);
			});
			
			ed.addButton('udsListStyleCheck', {
				title : 'Check-list con estilo',
				cmd : 'mceListStyleCheck',
				image : url + '/images/list_check.gif'
			});
			
			// Button Generic
			ed.addCommand('mceButtonGeneric', function() {
				var sel = ed.selection.getContent();
				sel = '[button link=]' + sel + '[/button]';
				ed.selection.setContent(sel);
			});
			
			ed.addButton('udsButton', {
				title : 'Crear botón',
				cmd : 'mceButtonGeneric',
				image : url + '/images/button.gif'
			});
			
			// Button Download
			ed.addCommand('mceButtonDownload', function() {
				var sel = ed.selection.getContent();
				sel = '[button type=download link=]' + sel + '[/button]';
				ed.selection.setContent(sel);
			});
			
			ed.addButton('udsButtonDownload', {
				title : 'Crear botón de descarga',
				cmd : 'mceButtonDownload',
				image : url + '/images/button_download.gif'
			});
			
			// Pullquote left
			ed.addCommand('mcePullLeft', function() {
				var sel = ed.selection.getContent();
				sel = '[pullquote aligh=left]' + sel + '[/pullquote]';
				ed.selection.setContent(sel);
			});
			
			ed.addButton('udsPullLeft', {
				title : 'Crear texto entrecomillado',
				cmd : 'mcePullLeft',
				image : url + '/images/pullquote_left.gif'
			});
			
			// Pullquote left
			ed.addCommand('mcePullRight', function() {
				var sel = ed.selection.getContent();
				sel = '[pullquote align=right]' + sel + '[/pullquote]';
				ed.selection.setContent(sel);
			});
			
			ed.addButton('udsPullRight', {
				title : 'Texto entrecomillado',
				cmd : 'mcePullRight',
				image : url + '/images/pullquote_right.gif'
			});
			
			// divider
			ed.addCommand('mceDivider', function() {
				sel = '[divider]';
				ed.selection.setContent(sel);
			});
			
			ed.addButton('udsDivider', {
				title : 'Crear linea divisoria',
				cmd : 'mceDivider',
				image : url + '/images/divider.gif'
			});
			
			// contact
			ed.addCommand('mceContact', function() {
				sel = '[uds-contact-form]';
				ed.selection.setContent(sel);
			});
			
			ed.addButton('udsContact', {
				title : 'Crear formulario de contacto',
				cmd : 'mceContact',
				image : url + '/images/contact.gif'
			});
			
			//  portfolio
			ed.addCommand('mcePortfolio', function() {
				sel = '[portfolio]';
				ed.selection.setContent(sel);
			});

			ed.addButton('udsPortfolio', {
				title : 'Insertar proyecto',
				cmd : 'mcePortfolio',
				image : url + '/images/portfolio.gif'
			});
			
			//  portfolio
			ed.addCommand('mceSlider', function() {
				var sel = ed.selection.getContent();
				sel = '[slider delay=1000 height=200px]' + sel + '[/slider]';
				ed.selection.setContent(sel);
			});

			ed.addButton('udsSlider', {
				title : 'Insertar presentación',
				cmd : 'mceSlider',
				image : url + '/images/slideshow.gif'
			});
			
			// Add a node change handler, selects the button in the UI when a image is selected
			ed.onNodeChange.add(function(ed, cm, e, collapsed) {
				cm.setDisabled('udsThirds',	collapsed);
				cm.setDisabled('udsTwoThirds', collapsed);
				cm.setDisabled('udsHalves',	collapsed);
				cm.setDisabled('udsFourths', collapsed);
				cm.setDisabled('udsThreeFourths', collapsed);
				cm.setDisabled('udsBox', collapsed);
				cm.setDisabled('udsBoxInfo', collapsed);
				cm.setDisabled('udsBoxSuccess', collapsed);
				cm.setDisabled('udsBoxWarn', collapsed);
				cm.setDisabled('udsBoxError', collapsed);
				cm.setDisabled('udsButton', collapsed);
				cm.setDisabled('udsButtonDownload', collapsed);
				cm.setDisabled('udsListStyle', collapsed);
				cm.setDisabled('udsListStyleCheck', collapsed);
				cm.setDisabled('udsPullLeft', collapsed);
				cm.setDisabled('udsPullRight', collapsed);
				cm.setDisabled('udsSlider', collapsed);
			});
		},

		/**
		 * Returns information about the plugin as a name/value array.
		 * The current keys are longname, author, authorurl, infourl and version.
		 *
		 * @return {Object} Name/value array containing information about the plugin.
		 */
		getInfo : function() {
			return {
					longname  : 'Moio',
					author 	  : '',
					authorurl : '',
					infourl   : '',
					version   : "1.0"
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('udsExtensions', tinymce.plugins.udsExtensions);
})();