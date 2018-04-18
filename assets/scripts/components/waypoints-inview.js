(function($) {

	$(document).ready(function() {

		var blocks = $(".inview");

		blocks.each(function(){
			var t = $(this);
			t.addClass("animated");

			var waypoint = new Waypoint.Inview({
				element: t,
				// handler: function(direction) {
				// 	t.addClass(t.data("animation"));
				// },
				enter: function(direction) {
					// console.log("enter" + t.data("id"));
					t.addClass(t.data("animation"));
				},
				entered: function(direction) {
					// console.log("entered" + t.data("id"));
				},
				exit: function(direction) {
					// console.log("exit" + t.data("id"));
				},
				exited: function(direction) {
					// console.log("exited" + t.data("id"));
					// t.removeClass(t.data("animation"));
				},
				// offset: "100%",
			});
		});

		$(window).trigger("resize").trigger("scroll");

	});
})(jQuery);