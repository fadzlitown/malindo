var loadBar;
loadBar = loadBar || (function() {
    var pleaseWaitDiv = $('<div class="modal fade" style="margin-top: 21%; overflow: hidden; z-index: 1060;" id="loadingModal">\n\
<div class="modal-dialog"><div class="col-sm-offset-4 col-sm-4"><div class="progress progress-striped active"><div class="progress-bar"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"><span class="sr-only"></span></div></div></div></div></div>');
    return {
        showPleaseWait: function() {
            pleaseWaitDiv.modal({
                backdrop: 'static',
                keyboard: false
            });
            $(".modal-backdrop").first().css("z-index", "1050");
        },
        hidePleaseWait: function() {
            pleaseWaitDiv.modal('hide');
            $(".modal-backdrop").first().css("z-index", "1040");

        },
    };
})();

jQuery(document).ready(function() {
    $(".alert").alert();
    $('.dropdown-toggle').dropdown();

//    new Morris.Line({
//        // ID of the element in which to draw the chart.
//        element: 'myfirstchart',
//        // Chart data records -- each entry in this array corresponds to a point on
//        // the chart.
//        data: graph_data,
//        // The name of the data record attribute that contains x-values.
//        xkey: graph_x_keys,
//        // A list of names of data record attributes that contain y-values.
//        ykeys: graph_y_keys,
//        // Labels for the ykeys -- will be displayed when you hover over the
//        // chart.
//        labels: graph_y_keys,
//        xLabels: graph_x_keys
//    });

    $('a.btnOpenModal').on('click', function(e) {
//        window.history.pushState("object or string", "Title", "/new-url"); //changing the url without refresh the page
        loadBar.showPleaseWait();
        var target_modal = $(e.currentTarget).data('target');
        var method = $(e.currentTarget).data('method');
        var remote_content = e.currentTarget.href;
        var modal = $(target_modal);
        var modalBody = $(target_modal);

        if (method === "create")
            modalBody = $(target_modal + ' .modal-body');

        var e = 1;
        modal.on('show.bs.modal', function() {
            if (e)
                modalBody.load(remote_content);
            e = 0;
        }).modal();
        loadBar.hidePleaseWait();
        return false;
    });

    $('a.btnEditModal').on('click', function(e) {
//        window.history.pushState("object or string", "Title", "/new-url"); //changing the url without refresh the page
        loadBar.showPleaseWait();
        var target_modal = $(e.currentTarget).data('target');
        var remote_content = e.currentTarget.href;

        var modal = $(target_modal);
        var e = 1;
        modal.on('show.bs.modal', function() {
            if (e)
                modal.load(remote_content);
            e = 0;
        }).modal();
        loadBar.hidePleaseWait();
        return false;
    });


    $('#viewModal').on('hidden.bs.modal', function() {
        $(this).removeData('bs.modal');
    });

    initModalSubmit();
});

/**
 * Init BtnModalSubmit
 */
function initModalSubmit() {
    $("#btnModalSubmit").on("click", function(e) {
        loadBar.showPleaseWait();
        var modal = $("#formModal");
        var form = modal.find("form");
        var action = form.attr("action");
        var form_data = form.serialize();
        e.preventDefault();
        $.ajax({
            url: action,
            type: 'POST',
            data: form_data,
            dataType: 'json',
            success: function(data)
            {
                loadBar.hidePleaseWait();

                if (data.status === "success") {
                    $('#formModal').modal("toggle");
                }
                else {
                    var modal_body = modal.find(".modal-body");
                    modal_body.html(data.response);
                }

            },
            error: function() {
            }
        });

    });
}

