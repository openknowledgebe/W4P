/**
 * PLEDGE
 */

$(document).ready(function() {

    // Get all categories
    // categories

    $('.plus').click(function() {
        var key = $(this).attr('data-key');
        increase(key);
    });

    $('.minus').click(function() {
        var key = $(this).attr('data-key');
        decrease(key);
    });

    function increase(id) {
        var checkboxContainer = $('.checkboxes_pledge_' + id);
        // Try to find unchecked & enabled items
        var found = checkboxContainer.find('.checkbox').not('.disabled').not('.checked');
        if (found.length > 0) {
            $(found[0]).addClass('checked');
        } else {
            $(checkboxContainer).append("<div class='checkbox checked'></div>")
        }
        updateCount(id);
    }

    function decrease(id) {
        var checkboxContainer = $('.checkboxes_pledge_' + id);
        // Try to find checked & enabled items
        var found = checkboxContainer.find('.checkbox.checked').not('.disabled');
        if (found.length > 0) {
            $(found[found.length - 1]).removeClass('checked');
        }
        updateCount(id);
    }

    function updateCount(id) {
        var checkboxContainer = $('.checkboxes_pledge_' + id);
        var found = checkboxContainer.find('.checkbox.checked');
        $('#pledge_' + id).val(found.length);
    }
});