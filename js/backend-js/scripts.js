jQuery(function () {
  var custom_uploader;
  jQuery('.gallery-wrapper').on('click', function (e) {
    e.preventDefault();

    if (custom_uploader) {
      custom_uploader.open();
      return;
    }


    var button = jQuery(this),
      custom_uploader = wp.media.frames.file_frame = wp.media({
        frame: 'select',
        title: 'Insert image',
        multiple: 'add', // for multiple image selection set to true
        button: {
          text: 'Use this image' // button label text
        },
      });
    var html = "";
    var vals = "";
    custom_uploader.open();

    custom_uploader.on('select', function () { // it also has "open" and "close" events
      var selection = custom_uploader.state().get('selection');
      var map = selection.map(function (attachment) {
        attachment = attachment.toJSON();

        // jQuery("button").after("<img src=" +attachment.url+">");

        jQuery('.remove_image_button').show();
        html += "<div class=\"admin-image-wrapper\"><img src=" + attachment.url + "></div>";
        vals += "," + attachment.id;

      });
      vals = vals.slice(1);
      html += "<input type='hidden' name='slider_images' id='slider_images' value='" + vals + "' />";
      jQuery(button).html(html);

    });
  });

  /*
   * Remove image event
   */
  jQuery('body').on('click', '.remove_image_button', function () {
    jQuery('.gallery-wrapper').html('<div class="upload">Upload Image</div>');
    jQuery('.remove_image_button').hide();

    return false;
  });
});