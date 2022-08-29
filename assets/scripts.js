jQuery(function($) {
    $('.type-case').on( 'click', function() {
        let typeButton = $( this ).attr( 'type' );
        let typeInsert = $( `div[type="${typeButton}"]` );
        $( typeInsert ).each( function( index, obj2 ){
            $( `div[type]` ).each( function ( index, obj1 ) {
                if (obj1 !== obj2) {
                    $(obj1).addClass( 'hide' );
                } else {
                    $(obj1).removeClass( 'hide', 'current-item' );
                }
            })
        });
    });
})
