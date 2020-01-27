
<div id="condition_field_label" class="label">{$form.condition_field.label}</div>
{$form.condition_field.html}

{literal}
    <script type="text/javascript">
        CRM.$(function($) {
            var is_active = $('.crm-price-field-form-block-is_active');
            var tbody = is_active.parent('tbody');
            var label = $('#condition_field_label');
            var field = $('#condition_field');
            tbody.append('<tr class="crm-price-field-form-block-condition_field"><td class="label">' + label.html() + '</td><td id="condition_field_content"></td></tr>');
            field.appendTo('#condition_field_content');
            label.hide();
        });
    </script>
{/literal}
