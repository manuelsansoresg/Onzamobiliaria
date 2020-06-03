if ($(".multiple").length > 0) {
    $('.multiple').multiselect({
        templates: {
            li: '<li><a href="javascript:void(0);"><label class="pl-2"></label></a></li>'
        },
        nonSelectedText: 'SELECCIONE UN ELEMENTO...',
        selectedClass: 'bg-light',
        onInitialized: function (select, container) {
            // hide checkboxes
            //container.find('input').addClass('d-none');
            //container.find('input[type=checkbox]').addClass('d-none');
            container.find('input[type=radio]').addClass('d-none');
        }
    });
}