/**
 * Portions of this code were adapted from puphpet:
 *
 * The MIT License (MIT)
 * Copyright (c) 2013 Juan Treminio and other contributors
 * https://puphpet.com
 */

(function ($) {
    'use strict';

    var templatesAdded = {};

    var Protobox = function () {};

    /*
     * Click on an element and update another element using data-update="target:value" attribute
     */
    Protobox.prototype.updateInput = function (e) {
        var $this = $(this);

        $.each($this.data(), function(key, value) {
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
            if ($target.is(':checkbox') && $this.is(':checked')) {
                $target.prop('checked', true);

                return;
            }

            $target.val(elm[1]);
        });
    }

    Protobox.prototype.selectize = function ($element) {
        // input or select elements; allows user to create their own tags
        $('.tags, .select-tags-editable', $element).selectize({
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
        Protobox.prototype.selectizeUser($element);

        // select single element; does not allow creating new tag
        $('.select-tag', $element).selectize({
            persist: false,
            create: false
        });

        // select elements; does not allow creating new tags
        $('.select-tags', $element).selectize({
            plugins: ['remove_button'],
            delimiter: ',',
            persist: false,
            create: false
        });
    }

    Protobox.prototype.selectizeUser = function ($element) {
        var $selectTagsUserInput = $('.select-tags-user-input', $element).selectize({
            plugins: ['remove_button'],
            delimiter: ',',
            persist: false,
            create: false,
            onItemAdd: function(value, $item) {
                var targetContainer     = '#' + $(this['$input'])[0].getAttribute('data-target-container');
                var targetNameStructure = $(this['$input'])[0].getAttribute('data-target-name');
                var elementName         = targetNameStructure + '[' + this.options[value].text + ']';

                var suffix = prompt('Enter Value:') || '0';
                var label  = this.options[value].text + ' = ' + suffix;
                var data   = $.extend({}, this.options[value], {
                    text: label
                });

                // Append this user input as a new hidden element
                $('<input>').attr({
                    type:  'hidden',
                    name:  elementName,
                    value: suffix
                }).appendTo(targetContainer);

                this.updateOption(value, data);
            },
            onItemRemove: function(value, $item) {
                var targetContainer     = '#' + $(this['$input'])[0].getAttribute('data-target-container');
                var targetNameStructure = $(this['$input'])[0].getAttribute('data-target-name');
                var elementName         = targetNameStructure + '[' + this.options[value].value + ']';

                $(targetContainer + ' input[name="' + elementName + '"]').remove();

                var data = $.extend({}, this.options[value], {
                    text: value
                });

                this.updateOption(value, data);
            }
        });

        // Adds pre-selected option values to selectize field
        for (var i = 0; i < $selectTagsUserInput.length; i++) {
            var $selectElement = $selectTagsUserInput[i].selectize;
            var targetContainer = '#' + $selectTagsUserInput[i].getAttribute('data-target-container');
            var $selectedItems = $(targetContainer);

            if (!$selectedItems.length) {
                continue;
            }

            $selectedItems.children().each(function() {
                var optionName  = this.getAttribute('data-option-name');
                var optionValue = $(this).val();

                var label = $selectElement.options[optionName].text + ' = ' + optionValue;
                var data  = $.extend({}, $selectElement.options[optionName], {
                    text: label
                });

                $selectElement.updateOption(optionName, data);
            });
        }

        return $selectTagsUserInput;
    };

    Protobox.prototype.template = function(e) {
        var $this       = $(this),
            tmpl        = $this.data('template'),
            name        = tmpl.replace('#', ''),
            template    = $(tmpl);

        if (template) {
            if ( ! templatesAdded[name])
                templatesAdded[name] = [];

            var id_start    = parseInt($this.data('id-start')),
                replacement = $this.data('replace'),
                append      = $this.data('append'),
                default_id  = templatesAdded[name].length > 0
                    ? templatesAdded[name][templatesAdded[name].length-1] 
                    : id_start,
                name_id     = default_id + 1,
                content     = template.html();

            $.each(replacement.split(','), function(key, value) {
                var replace = value.split(':'),
                    re = new RegExp('{' + replace[0] + '}', 'g');

                if (replace[1] == '[id]') {
                    content = content.replace(re, name_id);
                } else {
                    content = content.replace(re, replace[1]);
                }
            });

            var $row = $(content).insertBefore($this.closest(append));
            Protobox.prototype.selectize($row);

            templatesAdded[name].push(name_id);
        }
    };

    Protobox.prototype.templateRemove = function(e) {
        var $this       = $(this),
            tmpl        = $this.data('template-remove'),
            template    = $(tmpl),
            template_id = $this.data('template-id'),
            name        = tmpl.replace('#', '').replace('-' + template_id, '');

        if (template) {
            template.remove();
        }

        if (template_id && name in templatesAdded && template_id in templatesAdded[name]) {
            delete templatesAdded[name][template_id];
        }
    };

    Protobox.prototype.ajaxErrors = function(e) {
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

    Protobox.prototype.uploadConfig = function(e) {
        var tid, dropzone = document.documentElement;

        dropzone.addEventListener('dragover', handleDragOver, false);
        dropzone.addEventListener('dragleave', handleDragLeave, false);
        dropzone.addEventListener('drop', handleFileSelect, false);

        function handleDragOver(e) {
            clearTimeout(tid);
            e.stopPropagation();
            e.preventDefault && e.preventDefault();
            // Explicitly show this is a copy.
            e.dataTransfer.dropEffect = 'copy';

            $('#dropzone').fadeIn('slow');
        }

        function handleDragLeave(e) {
            tid = setTimeout(function () {
                e.stopPropagation();

                $('#dropzone').fadeOut('slow');
            }, 300);
        }

        function handleFileSelect(e) {
            clearTimeout(tid);
            e.stopPropagation();
            e.preventDefault && e.preventDefault();

            $('#dropzone').fadeOut('slow');

            var files = e.dataTransfer.files; // FileList object.

            // Only proceed when a single file is dropped
            if (files.length > 1 || !files.length) {
                return false;
            }

            var file = files[0],
                ext = file.name.split('.').pop().toLowerCase();

            // Only allow yaml uploads
            if (ext !== 'yaml' && ext !== 'yml') {
                return false;
            }

            var reader = new FileReader();

            // Closure to capture the file information.
            reader.onload = (function (theFile) {
                return function (e) {
                    submitForm(e.target.result);
                };
            })(file);

            // Read in the image file as a data URL.
            reader.readAsText(file);

            return false;
        }

        function submitForm(config) {
            if (!config.length) {
                return;
            }
            
            var form = $(
                '<form action="' + PROTOBOX_CONFIG.UPLOAD + '" method="post">' +
                    '<input type="hidden" name="config" value="' + config + '" />' +
                '</form>'
            );
            $('body').append(form);
            $(form).submit();
        }
    };

    $(function () {
        $(document).on('click', '.update-input', Protobox.prototype.updateInput)
        $(document).on('change', 'select.update-input', Protobox.prototype.updateInput);

        $(document).on('click', '[data-template]', Protobox.prototype.template);
        $(document).on('click', '[data-template-remove]', Protobox.prototype.templateRemove);

        //Eldarion ajax error handling
        //$(document).on('eldarion-ajax:success', Protobox.prototype.ajaxErrors);

        Protobox.prototype.selectize(null);

        Protobox.prototype.uploadConfig();
    });

}(jQuery));