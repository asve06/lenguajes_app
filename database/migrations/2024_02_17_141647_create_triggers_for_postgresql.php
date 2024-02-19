<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTriggersForPostgresql extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE OR REPLACE FUNCTION increase_stock()
            RETURNS TRIGGER AS $$
            BEGIN
              UPDATE Products
              SET current_stock = current_stock + NEW.entered_quantity
              WHERE productID = NEW.productID;
              RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;

            CREATE TRIGGER trg_increase_stock
            AFTER INSERT ON Purchases
            FOR EACH ROW
            EXECUTE FUNCTION increase_stock();
        ');

        DB::unprepared('
            CREATE OR REPLACE FUNCTION decrease_stock()
            RETURNS TRIGGER AS $$
            DECLARE
              new_stock INT;
            BEGIN
              UPDATE Products
              SET current_stock = current_stock - NEW.egressed_quantity
              WHERE productID = NEW.productID
              RETURNING current_stock INTO new_stock;

              IF new_stock < 0 THEN
                RAISE EXCEPTION \'Current stock cannot be negative.\';
              END IF;

              RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;

            CREATE TRIGGER trg_decrease_stock
            AFTER INSERT ON Sales
            FOR EACH ROW
            EXECUTE FUNCTION decrease_stock();
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS trg_increase_stock ON Purchases;');
        DB::unprepared('DROP FUNCTION IF EXISTS increase_stock;');
        DB::unprepared('DROP TRIGGER IF EXISTS trg_decrease_stock ON Sales;');
        DB::unprepared('DROP FUNCTION IF EXISTS decrease_stock;');
    }
}
