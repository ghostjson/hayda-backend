<?php

namespace Database\Seeders;

use App\Models\PageContent;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $home = new PageContent();
        $home->name = 'home';
        $home->content = '{"title_caption":"HAYDA Caption Here Here will be the HAYDA Caption","small_quote":"Small quote here","what_we_do":{"caption":"Create amam ipsum dolor sit amet, Beautiful nature, and rare feathers!.","content":[{"header":"Heading 1 Here","description":"Lorem ipsum dolor sit amet, blandit vel sapien vitae, condimentum ultricies magna et. Quisque euismod orci ut et lobortis aliquam."},{"header":"Heading 2 Here","description":"Lorem ipsum dolor sit amet, blandit vel sapien vitae, condimentum ultricies magna et. Quisque euismod orci ut et lobortis aliquam."},{"header":"Heading 3 Here","description":"Lorem ipsum dolor sit amet, blandit vel sapien vitae, condimentum ultricies magna et. Quisque euismod orci ut et lobortis aliquam."},{"header":"Heading 4 Here","description":"Lorem ipsum dolor sit amet, blandit vel sapien vitae, condimentum ultricies magna et. Quisque euismod orci ut et lobortis aliquam."},{"header":"Heading 5 Here","description":"Lorem ipsum dolor sit amet, blandit vel sapien vitae, condimentum ultricies magna et. Quisque euismod orci ut et lobortis aliquam."},{"header":"Heading 6 Here","description":"Lorem ipsum dolor sit amet, blandit vel sapien vitae, condimentum ultricies magna et. Quisque euismod orci ut et lobortis aliquam."}]},"services":{"caption":"Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.","content":[{"header":"Heading here","description":"Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.","icon":"plug"},{"header":"Heading here","description":"Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.","icon":"desktop"},{"header":"Heading here","description":"Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.","icon":"cloud"},{"header":"Heading here","description":"Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.","icon":"lightbulb"},{"header":"Heading here","description":"Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.","icon":"trophy"},{"header":"Heading here","description":"Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.","icon":"thumbs-up"},{"header":"Heading here","description":"Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.","icon":"rocket"},{"header":"Heading here","description":"Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.","icon":"flask"},{"header":"Heading here","description":"Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse condimentum porttitor cursumus.","icon":"umbrella"}]},"statistics":{"content":[{"title":"LINES OF CODE","icon":"code","value":"12416"},{"title":"CUPS OF COFFEE","icon":"coffee","value":"365"},{"title":"FINISHED PROJECTS","icon":"rocket","value":"114"},{"title":"SATISFIED CLIENTS","icon":"rocket","value":"14825"}]}}';
        $home->save();

        $about = new PageContent();
        $about->name = 'about';
        $about->content = '{"description_left":"The most happiest time of the day!. Morbi sagittis, sem quis lacinia faucibus, orci ipsum gravida tortor, vel interdum mi sapien ut justo. Nulla varius consequat magna, id molestie ipsum volutpat quis. A true story, that never been told!. Fusce id mi diam, non ornare orci. Pellentesque ipsum erat,\n\nfacilisis ut venenatis eu, sodales vel dolor. The most happiest time of the day!. Morbi sagittis, sem quis lacinia faucibus, orci ipsum gravida tortor, vel interdum mi sapien ut justo. Nulla varius consequat magna, id molestie ipsum volutpat quis. A true story, that never been told!. Fusce id mi diam, non ornare orci. Pellentesque ipsum erat, facilisis ut venenatis eu, sodales vel dolor.","description_right":"Pellentesque ipsum erat, facilisis ut venenatis eu, sodales vel dolor. The most happiest time of the day!. Morbi sagittis, sem quis lacinia faucibus, orci ipsum gravida tortor, vel interdum mi sapien ut justo. Nulla varius consequat magna, id molestie ipsum volutpat quis. A true story, that never been told!. Fusce id mi diam, non ornare orci. Pellentesque ipsum erat, facilisis ut venenatis eu, sodales vel dolor. Pellentesque ipsum erat, facilisis ut venenatis eu, sodales vel dolor.\n\nThe most happiest time of the day!. Morbi sagittis, sem quis lacinia faucibus, orci ipsum gravida tortor, vel interdum mi sapien ut justo. Nulla varius consequat magna, id molestie ipsum volut.","steps":[{"title":"CONCEPT","description":"The most happiest time of the day!. Morbi sagittis, sem quis lacinia faucibus, orci ipsum gravida tortor, vel interdum mi sapien ut justo. Nulla varius consequat magna, id molestie ipsum volutpat quis. A true story, that never been told!."},{"title":"DEVELOPMENT","description":"The most happiest time of the day!. Morbi sagittis, sem quis lacinia faucibus, orci ipsum gravida tortor, vel interdum mi sapien ut justo. Nulla varius consequat magna, id molestie ipsum volutpat quis. A true story, that never been told!."},{"title":"TESTING","description":"The most happiest time of the day!. Morbi sagittis, sem quis lacinia faucibus, orci ipsum gravida tortor, vel interdum mi sapien ut justo. Nulla varius consequat magna, id molestie ipsum volutpat quis. A true story, that never been told!."}]}';
        $about->save();

        $footer = new PageContent();
        $footer->name = 'footer';
        $footer->content = '{"who_we_are":"Built with love in Some address, Texas, USA All rights reserved. Copyright \u00a9 2020. HAYDA.","link_heading":"SHOP","links":[{"name":"Category 1","link":"#"},{"name":"Category 2","link":"#"},{"name":"Category 3","link":"#"},{"name":"Category 4","link":"#"},{"name":null,"link":"#"}]}';
        $footer->save();

    }
}
