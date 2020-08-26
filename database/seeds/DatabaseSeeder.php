<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Cтатусы
        DB::insert('INSERT INTO `status` (`title`,`alias`) VALUES (?,?)',['Поступило','1']);
        DB::insert('INSERT INTO `status` (`title`,`alias`) VALUES (?,?)',['Продано','2']);
        DB::insert('INSERT INTO `status` (`title`,`alias`) VALUES (?,?)',['Возвращено','3']);

        // Филиалы
        DB::insert('INSERT INTO `filials` (`title`, `adress`, `alias`) VALUES (?,?,?)',['Филиал №1', 'Тестовая 1б, тест 2-5', 'fil1']);
        DB::insert('INSERT INTO `filials` (`title`, `adress`, `alias`) VALUES (?,?,?)',['Филиал №2', 'Тестовая 4с, тест 7-9', 'fil2']);
        DB::insert('INSERT INTO `filials` (`title`, `adress`, `alias`) VALUES (?,?,?)',['Филиал №3', 'Тестовая 8я, тест 9-15', 'fil3']);

        // Товары
        DB::insert('INSERT INTO `products` (`title`, `text`, `prise`, `status_id`, `filials_id`) VALUES (?,?,?,?,?)',['Товар №1', 'Есть над чем задуматься', 102.50, 1, 2]);
        DB::insert('INSERT INTO `products` (`title`, `text`, `prise`, `status_id`, `filials_id`) VALUES (?,?,?,?,?)',['Товар №2', 'Мелочь, а приятно: сознание наших соотечественников не замутнено пропагандой', 50.50, 2, 3]);
        DB::insert('INSERT INTO `products` (`title`, `text`, `prise`, `status_id`, `filials_id`) VALUES (?,?,?,?,?)',['Товар №3', 'Звук клавиш печатной машинки даёт нам право принимать самостоятельные решения', 60.50, 3, 1]);
        DB::insert('INSERT INTO `products` (`title`, `text`, `prise`, `status_id`, `filials_id`) VALUES (?,?,?,?,?)',['Товар №4', 'Есть над чем задуматься: явные признаки победы институционализации лишьх', 78.50, 2, 3]);
        DB::insert('INSERT INTO `products` (`title`, `text`, `prise`, `status_id`, `filials_id`) VALUES (?,?,?,?,?)',['Товар №5', 'Есть над чем задуматься: явные признаки победы институционализации ', 3.50, 3, 2]);
        DB::insert('INSERT INTO `products` (`title`, `text`, `prise`, `status_id`, `filials_id`) VALUES (?,?,?,?,?)',['Товар №6', 'Реализация намеченных плановых заданий станет частью наших традиций', 15.50, 2, 1]);
        DB::insert('INSERT INTO `products` (`title`, `text`, `prise`, `status_id`, `filials_id`) VALUES (?,?,?,?,?)',['Товар №7', 'Современные технологии достигли такого уровня, что разбавленное изрядной долей эмпатии, рациональное мышление не оставляет шанса для системы обучения кадров, соответствующей насущным потребностям', 47.50, 1, 3]);
        DB::insert('INSERT INTO `products` (`title`, `text`, `prise`, `status_id`, `filials_id`) VALUES (?,?,?,?,?)',['Товар №8', 'Учитывая ключевые сценарии поведения, экономическая повестка сегодняшнего дня напрямую зависит от существующих финансовых и административных условий', 89.50, 2, 2]);
        DB::insert('INSERT INTO `products` (`title`, `text`, `prise`, `status_id`, `filials_id`) VALUES (?,?,?,?,?)',['Товар №9', 'Как уже неоднократно упомянуто, интерактивные прототипы призваны к ответу. Каждый из нас понимает очевидную вещь: укрепление и развитие внутренней структуры играет определяющее значение для прогресса профессионального сообщества', 23.50, 3, 3]);
        DB::insert('INSERT INTO `products` (`title`, `text`, `prise`, `status_id`, `filials_id`) VALUES (?,?,?,?,?)',['Товар №10', 'А также действия представителей оппозиции могут быть объявлены нарушающими общечеловеческие нормы этики и морали', 70.50, 2, 1]);
        DB::insert('INSERT INTO `products` (`title`, `text`, `prise`, `status_id`, `filials_id`) VALUES (?,?,?,?,?)',['Товар №11', 'Также как семантический разбор внешних противодействий является качественно новой ступенью позиций, занимаемых участниками в отношении поставленных задач', 50.50, 1, 2]);
        DB::insert('INSERT INTO `products` (`title`, `text`, `prise`, `status_id`, `filials_id`) VALUES (?,?,?,?,?)',['Товар №12', 'Как принято считать, сторонники тоталитаризма в науке, превозмогая сложившуюся непростую экономическую ситуацию, своевременно верифицированы', 14.90, 3, 1]);
        DB::insert('INSERT INTO `products` (`title`, `text`, `prise`, `status_id`, `filials_id`) VALUES (?,?,?,?,?)',['Товар №13', 'Приятно, граждане, наблюдать, как сторонники тоталитаризма в науке, инициированные исключительно синтетически, объединены в целые кластеры себе подобных!', 5.50, 1, 3]);
    }
}
