if(jQuery('.plus').length == 0) {
	jQuery( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<input type="button" value="+" class="plus" />' ).prepend( '<input type="button" value="-" class="minus" />' );

	jQuery( document ).on( 'click', '.pluswoo, .minuswoo', function() {
// Get values
var qty		= jQuery( this ).closest( '.quantity' ).find( '.qty' ),
currentVal	= parseFloat( qty.val() ),
max			= parseFloat( qty.attr( 'max' ) ),
min			= parseFloat( qty.attr( 'min' ) ),
step		= qty.attr( 'step' );
// Format values
if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
if ( max === '' || max === 'NaN' ) max = '';
if ( min === '' || min === 'NaN' ) min = 0;
if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;
// Change the value
if ( jQuery( this ).is( '.pluswoo' ) ) {
	if ( max && ( max == currentVal || currentVal > max ) ) {
		qty.val( max );
	} else {
		qty.val( currentVal + parseFloat( step ) );
	}
} else {
	if ( min && ( min == currentVal || currentVal < min ) ) {
		qty.val( min );
	} else if ( currentVal > 0 ) {
		qty.val( currentVal - parseFloat( step ) );
	}
}
// Trigger change event
qty.trigger( 'change' );
});



}
