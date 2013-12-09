(function ($) {
    'use strict';

    var Protobox = function () {};

    /*
     * Click on an element and update another element using data-update="target:value" attribute
     */
    Protobox.prototype.updateInput = function () {
        var $el = $(this);

        $.each($(this).data(), function(key, value) {
            // Only work with data-update attributes
            if (key != 'update') {
                return;
            }

            var elm = value.split(':'),
                $target = $('#' + elm[0]);

            // If target element is not defined as #foo, maybe it is an input,name,value target
            if (!$target.length) {
                $target = $('input[name="' + elm[0] + '"][value="'+ elm[1] +'"]')
            }

            // If target is a radio element, check it, no need to uncheck in future
            if ($target.is(':radio')) {
                $target.prop('checked', true);

                return;
            }

            /**
             * If target is checkbox element, check if clicked element was checked or unchecked.
             *
             * If unchecked, do not update target. We only want to handle positive actions
             */
            if ($target.is(':checkbox') && $el.is(':checked')) {
                $target.prop('checked', true);

                return;
            }

            $target.val(elm[1]);
        });
    }

    Protobox.prototype.selectize = function ($element) {
        // input or select elements; allows user to create their own tags
        var $selectTagsEditable = $('.tags, .select-tags-editable', $element).selectize({
            plugins: ['remove_button'],
            delimiter: ',',
            persist: false,
            create: function(input) {
                return {
                    value: input,
                    text: input
                }
            },
            maxItems: null,
            valueField: 'value',
            labelField: 'text',
            searchField: 'value'
        });

        // select elements; asks user for value of selected tags; cannot create own tags
        //var $selectTagsUserInput = PUPHPET.selectizeTagsUserInput($element);

        // select single element; does not allow creating new tag
        var $selectTag = $('.select-tag', $element).selectize({
            persist: false,
            create: false
        });

        // select elements; does not allow creating new tags
        var $selectTags = $('.select-tags', $element).selectize({
            plugins: ['remove_button'],
            delimiter: ',',
            persist: false,
            create: false
        });
    }

    Protobox.prototype.ajaxErrors = function(e, $el, data) {
        if (data.errors) {
            var hnd = $el.data('append'),
                rpl = $el.data('replace'),
                shw = $el.data('reveal');

            if (hnd) {
                $.each(data.errors, function (i, s) {
                    $(hnd).append('<p>' + s + '</p>');
                });
            }

            if (rpl) {
                var cnt = '';

                $.each(data.errors, function (i, s) {
                    cnt += '<p>' + s + '</p>';
                });

                $(rpl).replaceWith(cnt);
            }

            if (shw) {
                $(shw).show();
            }
        }
    };

    $(function () {
        $(document).on('click', '.update-input', Protobox.prototype.updateInput)
        $(document).on('change', 'select.update-input', Protobox.prototype.updateInput);

        //Eldarion ajax error handling
        //$(document).on('eldarion-ajax:success', Protobox.prototype.ajaxErrors);

        Protobox.prototype.selectize(null);
    });

}(jQuery));