$(function() {
	
        var projectRoot = "http://localhost:8888/projects/laravelImageGallery/public/";
        
	$(document).on("click", "#deleteImg", function(){
		var imageId = $("#imageId").val();
		var userConfirmation = confirm("Are you sure you want to delete this image?");
		if (userConfirmation)
			//location.href= "{{ URL::to() }}" "http://localhost:8888/laravel/imageGallery/public/images/destroy/3";
			location.href= projectRoot+"images/destroy/"+imageId;
	});

	$(document).on("click", "#closeMsg", function(){
		$("#messages").slideUp();
	});

	/* Submit Comment */
	$(document).on("click", "#submitComment", function(){
		var imageId = $("#imageId").val();
		var comment = $("#comment").val();
		var commentUrl = projectRoot+"comments/store";
		$.ajax({
			url: commentUrl,
			type: 'post',
			data: {'imageId' : imageId, 'comment' : comment},
			success: function(data){
				var newComment = '<div class="comments"><div class="theComment">'+ comment +'</div><div class="deleteComment" data-comment="'+ data +'" title="Delete Comment">X</div></div>';
				$("#commentsContainer").append(newComment);
			}
		});
	});

	/* Delete Comment */
	$(document).on("click", ".deleteComment", function(){

		var that = $(this);
		var commentId = $(this).data("comment");
		var deleteCommentUrl = projectRoot+"comments/destroy/"+commentId;
		$.ajax({
			url: deleteCommentUrl,
			type: 'post',
			data: {},
			success: function(data){
				that.parent().remove();
			}
		});
	});

	/* Like a Photo */
	$(document).on("click", "#like", function(){
		var imageId = $("#imageId").val();
		var likeUrl = projectRoot+"likes/update/"+imageId;
		$.ajax({
			url: likeUrl,
			type: 'post',
			data: {},
			success: function(data){
				$("#likes").text(data);
			}
		});
	});

});