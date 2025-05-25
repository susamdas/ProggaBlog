jQuery(document).ready(function(){
    'use strict';

    var sections_container = control_settings.sections_container;
    var saved_data_input = control_settings.saved_data_input;
    update_order();

    jQuery( sections_container ).sortable({
        axis: 'y',
        items: '> li:not(.panel-meta)',
        update: function(){
            update_order();
        },
        placeholder: 'ui-state-highlight'
    });

    function update_order(){
        var values = {};
        var idsInOrder = jQuery( sections_container ).sortable({
            axis: 'y',
            items: '> li:not(.panel-meta)',
        });
        var sections = idsInOrder.sortable('toArray');
        for(var i = 0; i < sections.length; i++){
            var section_id =  sections[i].replace('accordion-section-','');
            values[section_id] = (i+2)*5;
        }
        var data_to_send = JSON.stringify(values);
        jQuery(saved_data_input).val(data_to_send);
        jQuery(saved_data_input).trigger('change');
    }
});