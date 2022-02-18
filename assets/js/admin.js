;(function($) {
 
    $('table.wp-list-table.contacts').on('click', 'a.submitdelete', function(e) {
        e.preventDefault();

        if (!confirm(FaisalAcademy.confirm)) {
            return;
        }

        var self = $(this),
            id = self.data('id');

        // wp.ajax.send('faisal-academy-delete-contact', {
        //     data: {
        //         id: id,
        //         _wpnonce: FaisalAcademy.nonce
        //     }
        // })
        wp.ajax.post('faisal-academy-delete-contact', {
            id: id,
            _wpnonce: FaisalAcademy.nonce
        })
        .done(function(response) {

            self.closest('tr')
                .css('background-color', 'red')
                .hide(400, function() {
                    $(this).remove();
                });

        })
        .fail(function() {
            alert(FaisalAcademy.error);
        });
    });

})(jQuery);