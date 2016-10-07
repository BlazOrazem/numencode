// Responsive
if($(window).width() >= 1440){
    $(".side-panel").addClass("open");
    $(".sidepanel-toggle").parent().addClass("open");
    $("body").addClass("small-content");
}
else{
    $(".side-panel").removeClass("open");
    $(".sidepanel-toggle").parent().removeClass("open");
    $("body").removeClass("fixed-sidebar-example small-content");
}

$(window).resize(function(){
    if($(window).width() >= 1440){
        $(".side-panel").addClass("open");
        $(".sidepanel-toggle").parent().addClass("open");
        $("body").addClass("fixed-sidebar-example small-content");
    }
    else{
        $(".side-panel").removeClass("open");
        $(".sidepanel-toggle").parent().removeClass("open");
        $("body").removeClass("fixed-sidebar-example small-content");
    }
});


// Don't know what this does..
//Todo
//$(document).on('mouseover', '.list-group .checkbox', function () {
//    $('.list-group input:checkbox').each(function () {
//        $(this).on("change", function () {
//            if ($(this).is(":checked")) {
//                $(this).closest(".list-group-item").addClass("checked-todo").removeClass("list-item");
//            } else {
//                $(this).closest(".list-group-item").removeClass("checked-todo");
//            }
//        });
//    });
//});
//
//$(document).on('click', '.trash', function (e) {
//    var clearedCompItem = $(this).closest(".list-group-item").remove();
//    e.preventDefault();
//});


// JS Tree
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


//Data Tables
$('.datatable:not(.search):not(.search-paginate)').DataTable({
    "dom": '<"toolbar"><"clear-filter">rti',
    info: false,
    paging: true,
    responsive: true
});

$('.datatable.search:not(.paginate)').DataTable({
    "dom": '<"toolbar"><"clear-filter">frti',
    info: false,
    paging: true,
    responsive: true,
    "oLanguage": { "sSearch": "" }
});

$('.datatable.search.paginate').DataTable({
    "dom": '<"toolbar"><"top"fl>rt<"bottom"ip><"clear">',
    info: true,
    paging: true,
    responsive: true,
    "oLanguage": { "sSearch": "" }
});

$('.datatable').each(function() {
    var dataTableInfo = $(this).closest('.data-info');
    dataTableInfo.find('.toolbar').html('<h5 class="zero-m">' + $(this).data('title') + '</h5>');
    dataTableInfo.find('.dataTables_filter input').attr("placeholder", $(this).data('search'));
});
