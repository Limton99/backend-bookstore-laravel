(function($) {

	"use strict";

	var fullHeight = function() {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function(){
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

	$('#sidebarCollapse').on('click', function () {
      $('#sidebar').toggleClass('active');
  });

})(jQuery);

$('#updateBook').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('myid')
    var title = button.data('mytitle')
    var description = button.data('mydescription')
    var price = button.data('myprice')
    var count = button.data('mycount')
    var modal = $(this)
    modal.find('.modal-body #id').val(id);
    modal.find('.modal-body #title').val(title);
    modal.find('.modal-body #description').val(description);
    modal.find('.modal-body #price').val(price);
    modal.find('.modal-body #count').val(count);
    // modal.find('.modal-body #image').val(image);
});

$('#updateCategory').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('myid')
    var name = button.data('myname')

    var modal = $(this)
    modal.find('.modal-body #id').val(id);
    modal.find('.modal-body #name').val(name);

    // modal.find('.modal-body #image').val(image);
});


