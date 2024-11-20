public function up()
{
    // Comentar o eliminar la creación de la tabla
    // Schema::create('contacts', function (Blueprint $table) {
    //     $table->id();
    //     $table->string('name');
    //     $table->string('phone_number');
    //     $table->string('email')->nullable();
    //     $table->timestamps();
    // });
}

public function down()
{
    // Mantén este código para eliminar la tabla si es necesario
    Schema::dropIfExists('contacts');
}
