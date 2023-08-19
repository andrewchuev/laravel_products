<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateProductTest extends DuskTestCase
{
    use DatabaseMigrations;

    // Это будет выполнять миграции для вашей тестовой базы данных

    /** @test */
    public function user_can_create_a_product() {
        $this->browse( function ( Browser $browser ) {
            $browser->visit( '/products/create' ) // Предположим, у вас есть страница создания продукта
                    ->type( 'name', 'Sample Product' )
                    ->type( 'description', 'A sample product for testing' )
                    ->type( 'price', '99.99' )
                    ->press( 'Save' ) // Предположим, у вас есть кнопка с текстом "Add Product"
                    ->assertPathIs( '/products' ) // После добавления продукта, предположим, вы перенаправляете на страницу со списком продуктов
                    ->assertSee( 'Sample Product' ); // Проверяем, что на странице есть наш продукт
        } );
    }
}
