$(document).ready(function () {
    // get change input value of Image file
    $(this).on('change', '.custom-file-input', function (event) {
        var inputFile = event.currentTarget;
        $(inputFile).siblings('.custom-file-label').html(inputFile.files[0].name);
    });


    var $collectionHolder = $('#exp_list');
    var $addNewItem = $('<a href="#" class="btn btn-info">Neues Panel (Case Study) eingefügt</a>');
    // Append the addNewItem link to the collectionHolder
    $collectionHolder.append($addNewItem);

    // Add an index property to the collectionHolder to track the count of forms
    $collectionHolder.data('index', $collectionHolder.find('.panel-warning').length);

    // Add remove button to panel-warning
    $collectionHolder.find('.panel-warning').each(function () {
        addRemoveButton($(this));
    });

    // Handle click event for addNewItem
    $addNewItem.click(function (e) {
        e.preventDefault();
        addNewForm();
    });

    // Function to create and append a new form to the collectionHolder
    function addNewForm() {
        var prototype = $collectionHolder.data('prototype');
        var index = $collectionHolder.data('index');
        var newForm = prototype.replace(/__name__/g, index);
        $collectionHolder.data('index', index + 1);

        var $panel = $('<div class="panel panel-warning"><div class="panel-heading"></div></div>');


        var $panelBody = $('<div class="panel-body"></div>').append(newForm);
        $panel.append($panelBody);
        addRemoveButton($panel);
        $addNewItem.before($panel);
    }

    // Function to add remove button to the panel
    function addRemoveButton($panel) {
        var deleteUrl = $panel.find('.deleteUrl').data('delete-url');
        var $removeButton = $('<a href="' + (deleteUrl ? deleteUrl : '#') + '" class="btn btn-danger mb-3">Case Study löschen</a>');

        var $panelFooter = $('<div class="panel-footer"></div>').append($removeButton);

        $removeButton.click(function (e) {
            e.preventDefault();
            $panel.slideUp(1000, function () {
                $(this).remove();
            });
            if(deleteUrl){
                $.ajax({
                    url: deleteUrl,
                    type: 'DELETE',
                    success: function (response) {
                    },
                    error: function (error) {
                    }
                });
            }
        });
        $panel.append($panelFooter);
    }

});
