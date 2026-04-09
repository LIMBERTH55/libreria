<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fines', function (Blueprint $table) {
            // Clave primaria auto-incremental
            $table->id();

            // Clave foránea hacia loans con eliminación en cascada
            $table->foreignId('loan_id')
                  ->constrained('loans')
                  ->cascadeOnDelete();

            // Monto de la multa
            $table->decimal('amount', 8, 2);

            // Motivo de la multa
            $table->string('reason', 255);

            // Estado de la multa: pendiente o pagada
            $table->enum('status', ['pending', 'paid'])->default('pending');

            // Fecha de pago (opcional)
            $table->date('paid_at')->nullable();

            // Campos de auditoría
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fines');
    }
};
