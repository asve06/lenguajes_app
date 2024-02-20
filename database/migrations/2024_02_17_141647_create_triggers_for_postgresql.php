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
            CREATE OR REPLACE FUNCTION aumentar_existencia()
            RETURNS TRIGGER AS $$
            BEGIN
              UPDATE Productos
              SET existencia_actual = existencia_actual + NEW.cantidad_ingresada
              WHERE "productoID = NEW.productoID;
              RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;

            CREATE TRIGGER trg_aumentar_existencia
            AFTER INSERT ON Ingresos
            FOR EACH ROW
            EXECUTE FUNCTION aumentar_existencia();
        ');

        DB::unprepared('
            CREATE OR REPLACE FUNCTION disminuir_existencia()
            RETURNS TRIGGER AS $$
            DECLARE
              nueva_existencia INT;
            BEGIN
              UPDATE Productos
              SET existenciaActual = existenciaActual - NEW.cantidadEgresada
              WHERE productoID = NEW.productoID
              RETURNING existenciaActual INTO nueva_existencia;

              IF nueva_existencia < 0 THEN
                RAISE EXCEPTION \'La existencia actual no puede ser negativa.\';
              END IF;

              RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;

            CREATE TRIGGER trg_disminuir_existencia
            AFTER INSERT ON Egresos
            FOR EACH ROW
            EXECUTE FUNCTION disminuir_existencia();
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS trg_aumentar_existencia ON Ingresos;');
        DB::unprepared('DROP FUNCTION IF EXISTS aumentar_existencia;');
        DB::unprepared('DROP TRIGGER IF EXISTS trg_disminuir_existencia ON Egresos;');
        DB::unprepared('DROP FUNCTION IF EXISTS disminuir_existencia;');    }
}
