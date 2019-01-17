<?php
final class Auto{

    public $id,

    public $carBrand; 

    public $carEngine; 

    public $carFuelTankCapacity; 

    public $carGear; 

    public $carGroundClearance; 

    public $carMoment; 

    public $carName; 

    public $carOrigin; 

    public $carPower; 

    public $carPrice; 

    public $carPriceDeviation; 

    public $carSize; 

    public $carTurningCircle; 

    public $carType; 

    /**
	 * Constructor.
	 *
	 * @since 3.5.0
	 *
	 */
	public function __construct( $auto ) {
		foreach ( get_object_vars( $auto ) as $key => $value )
			$this->$key = $value;
    }
    
}
?>