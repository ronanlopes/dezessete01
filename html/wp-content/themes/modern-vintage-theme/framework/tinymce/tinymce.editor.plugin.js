(function() {

	tinymce.create('tinymce.plugins.indiegroundframework_shortcodes', {
		init : function(ed, url) {

			ed.addCommand('indiegroundframework_shortcodes', function() {
				ed.windowManager.open({
					file : url + '/interface.php',
					width : 500 + ed.getLang('indiegroundframework_shortcodes.delta_width', 0),
					height : 600 + ed.getLang('indiegroundframework_shortcodes.delta_height', 0),
					inline : 1
				}, {
					plugin_url : url
				});
			});

			ed.addButton('indiegroundframework_shortcodes', {
				title : 'Indieground Shortcodes',
				cmd : 'indiegroundframework_shortcodes',
				image : url + '/ig-tinymce-button.png'
			});

			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('indiegroundframework_shortcodes', n.nodeName == 'IMG');
			});

		},

		createControl : function(n, cm) {
			return null;
		},

		getInfo : function() {
			return {
					longname  : 'indiegroundframework_shortcodes',
					author 	  : 'Indieground team',
					version   : "1.0"
			};
		}
	});

	tinymce.PluginManager.add('indiegroundframework_shortcodes', tinymce.plugins.indiegroundframework_shortcodes);

})();