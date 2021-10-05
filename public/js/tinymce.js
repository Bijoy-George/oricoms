$(document).ready(function () {

	tinyMCE.init({
		// General options
		mode : "textareas",
		editor_selector:"tinymce",
                elements : "ajaxfilemanager",
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,table,advhr,advimage,save,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",
                height : "250",
                convert_urls: false,
                relative_urls : false,
                width: "100%",

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,image,code",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",

                file_browser_callback : "ajaxfilemanager",
                valid_elements: '*[*]',
                extended_valid_elements : '*[*]',
                element_format : 'html',
		// Example content CSS (should be your site CSS)

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},

			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
});