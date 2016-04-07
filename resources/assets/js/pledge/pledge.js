/**
 * PLEDGE
 */

$(document).ready(function() {

    // Get all categories
    // categories

    $('.plus').click(function(ev) {
        ev.preventDefault();
        var key = $(this).attr('data-key');
        increase(key);
    });

    $('.minus').click(function(ev) {
        ev.preventDefault();
        var key = $(this).attr('data-key');
        decrease(key);
    });

    $('.donation-tier-item').click(function(ev) {
        ev.preventDefault();
        $('.donation-tier-item').removeClass('active');
        $(this).addClass('active');
        var money = $(this).attr('data-tier');
        $("#currency").val(money);
    })

    $("#currency").keyup(function(){
        var currency = $("#currency").val();
        $('.donation-tier-item').removeClass('active');
        $('.donation-tier-item').each(function(index) {
            var tierCurrency = $(this).attr('data-tier');
            if (Number(tierCurrency) <= Number(currency)) {
                $('.donation-tier-item').removeClass('active');
                $(this).addClass('active');
            }
        });
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

    function selectTier(sender, amount) {
        return false;
        $('.donation-tier-item').removeClass('active');
        sender.addClass('active');
    }
});