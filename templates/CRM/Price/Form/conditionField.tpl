
<div id="condition_field_label_1" class="label">{$form.condition_field_1.label}</div>
{$form.condition_field_1.html}

<div id="condition_field_label_2" class="label">{$form.condition_field_2.label}</div>
{$form.condition_field_2.html}
{literal}
    <script type="text/javascript">
        CRM.$(function($) {
            var is_active = $('.crm-price-field-form-block-is_active');
            var tbody = is_active.parent('tbody');
            var label = $('#condition_field_label_1');
            var field = $('#condition_field_1');
            tbody.append('<tr class="crm-price-field-form-block-condition_field_1"><td class="label">' + label.html() + '</td><td id="condition_field_content_1"></td></tr>');
            field.appendTo('#condition_field_content_1');
            label.hide();
            label = $('#condition_field_label_2');
            field = $('#condition_field_2');
            tbody.append('<tr class="crm-price-field-form-block-condition_field_2"><td class="label">' + label.html() + '</td><td id="condition_field_content_2"></td></tr>');
            field.appendTo('#condition_field_content_2');
            label.hide();
        });
    </script>
{/literal}
