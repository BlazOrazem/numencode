$(function() {
	$('#jstree').jstree({
		'core' : {
			'themes' : {
				'responsive': false
			}
		},
		'types' : {
			'default' : {
				'icon' : 'jt jt-page'
			},
			"folder" : {
				"icon" : "jt jt-folder"
			},
			"new" : {
				"icon" : "jt jt-new"
			}
		},
		"plugins" : [ "types", "state" ]
	});
});

