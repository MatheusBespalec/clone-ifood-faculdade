<?php

use App\Enuns\BrazilStates;
use App\Models\Order;
use App\Models\Product;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
//        Schema::table('users', function (Blueprint $table) {
//            $table->string('google_id')->nullable()->comment("Identificador do Google do usuário")->change();
//            $table->string('facebook_id')->nullable()->comment("Identificador do Facebbook do usuário")->change();
//            $table->string('name')->comment("Nome do usuário")->change();
//            $table->string('email')->comment("Email do usuário")->change();
//            $table->char("phone", 11)->nullable()->comment("Telefone do usuário")->change();
//            $table->char("verification_code", 6)->nullable()->comment("Código de verificação para login do usuário")->change();
//            $table->timestamp("verification_code_expiration")->nullable()->comment("Data de expiração do verification_code do usuário")->change();
//            $table->timestamp("created_at")->comment("Data de criação do usuário")->change();
//            $table->timestamp("updated_at")->comment("Data da ultima atualização dos dados do usuário")->change();
//        });
//
//        Schema::table('restaurants', function (Blueprint $table) {
//            $table->string("name", 100)->comment("Nome do restaurante")->change();
//            $table->string("thumbnail")->nullable()->comment("URL da thumbnail do restaurante")->change();
//            $table->string("description")->nullable()->comment("Descrição do restaurante")->change();
//            $table->string("street", 100)->nullable()->comment("Rua do endereço do restaurante")->change();
//            $table->string("neighborhood", 100)->nullable()->comment("Bairro do endereço do restaurante")->change();
//            $table->string("number", 50)->nullable()->comment("Numero do endereço do restaurante")->change();
//            $table->string("city", 100)->nullable()->comment("Cidade do endereço do restaurante")->change();
//            $table->char("zip_code", 9)->nullable()->comment("Cep do endereço do restaurante")->change();
//            $table->enum("state", array_map(fn (BrazilStates $state) => $state->value, BrazilStates::cases()))
//                ->nullable()->comment("Sigla do estado do endereço do restaurante")->change();
//            $table->timestamp("created_at")->comment("Data de criação do restaurante")->change();
//            $table->timestamp("updated_at")->comment("Data da ultima atualização dos dados do restaurante")->change();
//        });
//
//        Schema::table('products', function (Blueprint $table) {
//            $table->string("name", 100)->comment("Nome do produto")->change();
//            $table->string("image")->nullable()->comment("URL da imagem do produto")->change();
//            $table->string("description")->nullable()->comment("Descrição do produto")->change();
//            $table->decimal("price", 7)->comment("Preço do produto")->change();
//            $table->foreignIdFor(Restaurant::class)->comment("Chave estrangeira do restaurante a que o produto pertence")->change();
//            $table->timestamp("created_at")->comment("Data de criação do produto")->change();
//            $table->timestamp("updated_at")->comment("Data da ultima atualização dos dados do produto")->change();
//        });
//
//        Schema::table('orders', function (Blueprint $table) {
//            $table->foreignIdFor(User::class)->comment("Chave estrangeira do usuario que realizou o pedido")->change();
//            $table->foreignIdFor(Restaurant::class)->comment("Chave estrangeira do restaurante que onde foi feito o pedido")->change();
//            $table->tinyInteger("status")->comment("Status do pedido")->change();
//            $table->tinyInteger("delivery_type")->comment("Tipo de entrega do pedido (retirada ou delivery)")->change();
//            $table->tinyInteger("payment_type")->comment("Tipo de pagamento do pedido (pelo site ou ao retirar/receber o pedido)")->change();
//            $table->tinyInteger("payment_method")->comment("Método de pagamento do pedido")->change();
//            $table->string("zip_code")->nullable()->comment("Cep do endereço onde o pedido sera retirado/entregue")->change();
//            $table->string("street")->nullable()->comment("Rua do endereço onde o pedido sera retirado/entregue")->change();
//            $table->string("neighborhood")->nullable()->comment("Bairro do endereço onde o pedido sera retirado/entregue")->change();
//            $table->string("number")->nullable()->comment("Número do endereço onde o pedido sera retirado/entregue")->change();
//            $table->string("complement")->nullable()->comment("Complemento do endereço onde o pedido sera retirado/entregue")->change();
//            $table->string("city")->nullable()->comment("Cidade do endereço onde o pedido sera retirado/entregue")->change();
//            $table->string("state")->nullable()->comment("Sigla do estado do endereço onde o pedido sera retirado/entregue")->change();
//            $table->timestamp("created_at")->comment("Data de criação do pedido")->change();
//            $table->timestamp("updated_at")->comment("Data da ultima atualização dos dados do pedido")->change();
//        });
//
//        Schema::table('addresses', function (Blueprint $table) {
//            $table->foreignIdFor(User::class)->comment("Chave estrangeira do usuario ao que pertence o endereço")->change();
//            $table->string("name", 100)->comment("Nome que o usuario usa para identificar o endereço")->change();
//            $table->char("zip_code", 10)->comment("Cep do endereço")->change();
//            $table->string("street", 100)->comment("Rua do endereço")->change();
//            $table->string("neighborhood", 100)->nullable()->comment("Bairro do endereço")->change();
//            $table->string("number", 50)->comment("Número do endereço")->change();
//            $table->string("complement", 50)->nullable()->comment("Complemento do endereço")->change();
//            $table->string("city", 100)->comment("Cidade do endereço")->change();
//            $table->boolean("active")->comment("Se este é o endereço que esta pré-definido para ser usado no próximo pedido do cliente")->change();
//            $table->enum("state", array_map(fn (BrazilStates $state) => $state->value, BrazilStates::cases()))->comment("Sigla do estado do endereço")->change();
//            $table->timestamp("created_at")->comment("Data de criação do endereço")->change();
//            $table->timestamp("updated_at")->comment("Data da ultima atualização dos dados do endereço")->change();
//        });
//
//        Schema::table('order_product', function (Blueprint $table) {
//            $table->foreignIdFor(Order::class)->comment("Chave estrangeira do pedido ao qual o item pertence")->change();
//            $table->foreignIdFor(Product::class)->comment("Chave estrangeira do produto ao qual o item pertence")->change();
//            $table->tinyInteger("quantity")->comment("Quantidade que foi comprada do item")->change();
//            $table->decimal("unit_price", 7)->comment("Preço unitario que o item foi vendido")->change();
//        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
//        Schema::table('users', function (Blueprint $table) {
//            //
//        });
    }
};
