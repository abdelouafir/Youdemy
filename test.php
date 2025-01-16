<?php


class Event 
{
    protected string $title;
    protected DateTime $date;
    protected int $availableSeats;
    protected array $reservations;

    function __construct(string $title, DateTime $date, int $availableSeats, array $reservations) 
    {
        $this->title = $title;
        $this->date = $date;
        $this->availableSeats = $availableSeats;
        $this->reservations = $reservations;
    }

    // public function reserveSeat(string $userId) : string|bool 
    // {
    //     if($this->availableSeats > 0) {
    //         // array_push($this->reservations, $userId);
    //         $this->reservations = $userId;
    //         $this->availableSeats--;
    //         return "Seat reserved successfully";
    //     }

    //     return false;
    // }

    private function reserveSeatById(string $userId)
    {
                if($this->availableSeats > 0) {
                    // array_push($this->reservations, $userId);
                    $this->reservations = $userId;
                    $this->availableSeats--;
                    return "Seat reserved successfully";
                }

                return false;
        echo "reserve seats by id function called";
    }

    private function reserveSeatWithDetails()
    {
        echo "reserve seats with details function called";
    }


    public function __toString() 
    {
        // var_dump($this->date);
        return sprintf("Title: %s <br> Date: %s <br>  Avaialble seats: %d <br> Reservations %d <br>",$this->title, $this->date->format('Y-m-d'), $this->availableSeats, $this->reservations);
    }

    function __call($name, $arguments) 
    {
        if($name === "reserveSeat" && count($arguments) === 1) {
            return $this->reserveSeatById($arguments[0]);
        }
        else if ($name === "reserveSeat" && count($arguments) === 2) {
            return $this->reserveSeatWithDetails();
        }
        else {
            return "error";
        }

    }

    public static function createSampleEvents() {
        $array = [];
        $array[0] = new Event("event", new DateTime('2024-02-02'), 20, []);
        $array[1] = new PremuimEvent("event premuim", new DateTime('2025-1-1'), 10, [], 200);

        return $array;
    }
}


class PremuimEvent extends Event
{
    private float $price;

    function __construct(string $title, DateTime $date, int $availableSeats, array $reservations, float $price)
    {
        parent::__construct($title, $date, $availableSeats, $reservations);
        $this->price = $price;
    }

    public function reserveSeat(string $userId) : string
    {
        $result = $this->reserveSeat($userId);
        if($result) { 
            return $result . "$this->price";
        }
    }

    function __toString()
    {
        $result = $this->__toString();
        return $result . "$this->price";
    }



}

$events = Event::createSampleEvents();
echo "<pre>";
print_r($events);
echo "</pre>";
$events[0]->reserveSeat('ali');
// echo $obj;
// $obj->reserveSeat(3);
// $obj->reserveSeat(,)