$(document).ready(function() {
    $('.btn-plus').click(function() {
        $element = $(this).parents('tr');
        $price = $element.find('#pricelist').val();
        $qty = Number($element.find('#qty').val());
        $total = $price * $qty;
        console.log($total);
        $element.find('#total').html($total + 'Kyats')
        sum();

    })

    $('.btn-minus').click(function() {
        $element = $(this).parents('tr');
        $price = $element.find('#pricelist').val();
        $qty = Number($element.find('#qty').val());
        $total = $price * $qty;
        console.log($total);
        $element.find('#total').html($total + 'Kyats')
        sum();
    })

    function sum() {
        $dd = 0;
        $('#tablebox tbody tr ').each(function(index, row) {
            $dd += Number($(row).find('#total').text().replace('Kyats', ''));
        });

        $('#ttprice').html(`${$dd}Kyats`)
        $('#sum').html(`${$dd+4000}Kyats`)

    }
})