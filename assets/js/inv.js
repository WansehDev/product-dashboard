$(document).ready(function() {
               
    $('.up').click(function() {
        var $qty1 = $(this).parent().siblings();
        increase_value($qty1);
    });

    $('.down').click(function() {
        var $qty1 = $(this).parent().siblings();
        decrease_value($qty1);
    });

    function decrease_value($arr) {
        var value = parseInt($($arr[1]).val());
        if (value > 0) {
            value = value - 1;
        } else {
            value = 0;
        }
        $($arr[1]).val(value);

    }

    function increase_value($arr) {
        $val = $($arr[1]).val();
        var currentVal = parseInt($val);
        if (!currentVal || currentVal == NaN)
            currentVal = 0;
            $($arr[1]).val(currentVal + 1);
    }
});