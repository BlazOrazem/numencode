<?php

use Numencode\Models\Page\Page;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'id'         => 1,
                'parent_id'  => null,
                'route_id'   => 1,
                'menu'       => 'sidebar',
                'layout'     => 'default',
                'title'      => 'Tasks list',
                'lead'       => 'Display a set of tasks.',
                'body'       => "<p>This is the demo plugin with the name of Tasks, which displays a list of all tasks.</p>",
                'sort_order' => 10,
                'is_hidden'  => null,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id'         => 2,
                'parent_id'  => null,
                'route_id'   => 2,
                'menu'       => 'sidebar',
                'layout'     => 'default',
                'title'      => 'Random task',
                'lead'       => 'Display a random task.',
                'body'       => "<p>This is the demo plugin with the name of Tasks, which displays a random task.</p>",
                'sort_order' => 20,
                'is_hidden'  => null,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id'         => 3,
                'parent_id'  => null,
                'route_id'   => 3,
                'menu'       => 'sidebar',
                'layout'     => 'default',
                'title'      => 'Specific task',
                'lead'       => 'Display a specific task.',
                'body'       => "<p>This is the demo plugin with the name of Tasks, which displays a specific task with some attributes.</p>",
                'sort_order' => 30,
                'is_hidden'  => null,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id'         => 4,
                'parent_id'  => null,
                'route_id'   => 4,
                'menu'       => 'main',
                'layout'     => 'default',
                'title'      => 'Company',
                'lead'       => 'About our financial consulting firm.',
                'body'       => "<p>Company is a full-service financial consulting firm dedicated to helping our clients build wealth and protect their hard-earned assets. Our firm is completely independent, so our loyalty belongs exclusively to our clients - not to a parent company.</p><p>Our independence enables us to establish working relationships with a number of industry-leading brokerage firms and insurance providers whose products we leverage to create customized client portfolios. We recommend only those products and services that can be tailored to suit our clients' unique needs.</p><p>Our firm works exclusively on fee-based compensation. This approach takes commissions out of the equation and helps ensure that you receive objective advice that fits your particular needs and situation, not some hidden agenda. It also means that we are here for you, ready to offer ongoing financial expertise whenever you need it, whether or not you are ready to invest.</p><p>For more information about our firm and the services we offer, contact us today.</p>",
                'sort_order' => 10,
                'is_hidden'  => null,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id'         => 5,
                'parent_id'  => null,
                'route_id'   => 5,
                'menu'       => 'main',
                'layout'     => 'default',
                'title'      => 'Our Services',
                'lead'       => 'We offer a full range of financial services.',
                'body'       => "<p>When developing a customized financial program, I will walk you through a step-by-step process that is designed to make you feel confident in your decisions.</p><p>Once your goals have been established, appropriate strategies are customized to suit your vision and objectives. I can help you execute a sound financial program utilizing the following products and services:</p><ul><li>Tax-reduction strategies</li><li>Investment management, including stocks and mutual funds</li><li>Retirement planning</li><li>Estate planning and preservation</li><li>Asset protection through insurance and annuity products</li></ul>",
                'sort_order' => 20,
                'is_hidden'  => null,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id'         => 6,
                'parent_id'  => null,
                'route_id'   => 6,
                'menu'       => 'main',
                'layout'     => 'default',
                'title'      => 'Qualifications',
                'lead'       => 'Each of our agents has extensive personal and professional experience.',
                'body'       => "<p>Company offers clients an impressive depth of expertise in investment planning, insurance, and estate planning.</p><p>During our 20 years in business, we have provided comprehensive financial advice to over 1000 investors.</p><p>All Company advisors hold a variety of professional designations and are well versed in a number of financial disciplines. Our combined education and experience position us to offer broad-based financial advice that our clients can trust.</p><p>To meet with a Company advisor, contact us today.</p>",
                'sort_order' => 30,
                'is_hidden'  => null,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id'         => 7,
                'parent_id'  => null,
                'route_id'   => 7,
                'menu'       => 'main',
                'layout'     => 'default',
                'title'      => 'Contact',
                'lead'       => null,
                'body'       => null,
                'sort_order' => 40,
                'is_hidden'  => null,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id'         => 8,
                'parent_id'  => 7,
                'route_id'   => 8,
                'menu'       => 'main',
                'layout'     => 'map',
                'title'      => 'Our location',
                'lead'       => 'We are located in the center of the capital city.',
                'body'       => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d692.2493657615338!2d14.505674029280371!3d46.051148848694524!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47652d63b27f653d%3A0xd814b742356d4593!2sTromostovje%2C+Stritarjeva+ulica%2C+1000+Ljubljana!5e0!3m2!1ssl!2ssi!4v1494754048011" width="100%" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>',
                'sort_order' => 10,
                'is_hidden'  => null,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id'         => 9,
                'parent_id'  => 7,
                'route_id'   => 9,
                'menu'       => 'main',
                'layout'     => 'contact',
                'title'      => 'Contact us',
                'lead'       => 'Fill out the form and contact us now.',
                'body'       => null,
                'sort_order' => 20,
                'is_hidden'  => null,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'id'         => 10,
                'parent_id'  => null,
                'route_id'   => 12,
                'menu'       => 'main',
                'layout'     => 'default',
                'title'      => 'Blog',
                'lead'       => null,
                'body'       => null,
                'sort_order' => 50,
                'is_hidden'  => null,
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
        ];

        foreach ($items as $item) {
            Page::forceCreate($item);
        }

        $translationPage = Page::find(1);
        $translationPage->saveTranslation('sl', [
            'title' => 'Seznam opravil',
            'lead'  => 'Prikaži seznam vseh opravil.',
            'body'  => "<p>To je demo vtičnik z imenom Tasks, ki prikaže seznam vseh opravil.</p>",
        ]);

        $translationPage = Page::find(2);
        $translationPage->saveTranslation('sl', [
            'title' => 'Naključno opravilo',
            'lead'  => 'Prikaži naključno opravilo.',
            'body'  => "<p>To je demo vtičnik z imenom Tasks, ki prikaže naključno opravilo.</p>",
        ]);

        $translationPage = Page::find(3);
        $translationPage->saveTranslation('sl', [
            'title' => 'Specifično opravilo',
            'lead'  => 'Prikaži specifično opravilo.',
            'body'  => "<p>To je demo vtičnik z imenom Tasks, ki prikaže specifično opravilo z nekaterimi atributi.</p>",
        ]);

        $translationPage = Page::find(4);
        $translationPage->saveTranslation('sl', [
            'title' => 'O podjetju',
            'lead'  => 'Predstavitev finančno svetovalnega podjetja.',
            'body'  => "<p>Podjetje ponuja polno storitev finančno svetovalnega podjetja, ki pomaga našim strankam graditi bogastvo in zaščititi njihova trdo prislužena sredstva. Naše podjetje je popolnoma neodvisno, tako da naša zvestoba pripada izključno našim strankam - ne matični družbi.</p><p>Naša neodvisnost nam omogoča, da vzpostavljamo delovne odnose s številnimi vodilnimi borznoposredniškimi hišami in ponudniki zavarovanj, katerih izdelke lahko prilagodimo po meri portfeljev naših strank. Priporočamo le tiste izdelke in storitve, ki jih lahko prilagajamo tako, da ustrezajo edinstvenim potrebam naših strank.</p><p>Naše podjetje deluje izključno na odškodninah, ki temeljijo na pristojbinah. Ta pristop odstrani provizije iz enačbe in pomaga zagotoviti, da boste prejeli objektivne nasvete, ki ustrezajo vašim posebnim potrebam in razmeram, brez skrite agende. To pomeni, da smo tu za vas, pripravljeni ponuditi stalno finančno znanje, ko ga potrebujete, če ste pripravljeni investirati.</p><p>Za več informacij o našem podjetju in storitvah, ki jih ponujamo, se obrnite na nas še danes.</p>",
        ]);

        $translationPage = Page::find(5);
        $translationPage->saveTranslation('sl', [
            'title' => 'Naše storitve',
            'lead'  => 'Nudimo celoten spekter finančnih storitev.',
            'body'  => "<p>Pri razvoju prilagojenega finančnega programa, vas bomo vodili skozi postopek korak za korakom, ki je zasnovan tako, da boste prepričani v svoje odločitve.</p><p>Ko vzpostavimo vaše cilje, se ustrezne strategije prilagodijo vaši viziji in ciljem. Pomagamo vam lahko izvesti dober finančni program z uporabo naslednjih proizvodov in storitev:</p><ul><li>Strategija zmanjševanja davkov</li><li>Upravljanje naložb, vključno z delnicami in vzajemnimi skladi</li><li>Načrtovanje pokojninskega sklada</li><li>Načrtovanje in ohranjanje nepremičnin</li><li>Varovanje premoženja z zavarovalnimi rentami</li></ul>",
        ]);

        $translationPage = Page::find(6);
        $translationPage->saveTranslation('sl', [
            'title' => 'Kvalifikacije',
            'lead'  => 'Vsak od naših agentov ima bogate osebne in poklicne izkušnje.',
            'body'  => "<p>Podjetje ponuja strankam impresivno poglobljeno strokovno znanje pri načrtovanju investicij, zavarovanju in nepremičninskem načrtovanju.</p><p>V naših 20 letih poslovanja, smo celovito finančno svetovanje nudili že več kot 1000 investitorjem.</p><p>Vsi svetovalci Podjetja posedujejo različne strokovne označbe in so dobro seznanjeni v številnih finančnih disciplinah. Naše združeno znanje in izkušnje sta razlog za ponudbo široko zastavljenega finančnega svetovanja, ki mu naše stranke lahko zaupajo.</p><p>Za srečanje s svetovalcem podjetja, nas pokličite še danes.</p>",
        ]);

        $translationPage = Page::find(7);
        $translationPage->saveTranslation('sl', [
            'title' => 'Kontakt',
            'lead'  => null,
            'body'  => null,
        ]);

        $translationPage = Page::find(8);
        $translationPage->saveTranslation('sl', [
            'title' => 'Kje se nahajamo',
            'lead'  => 'Nahajamo se v centru glavnega mesta.',
            'body'  => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d692.2493657615338!2d14.505674029280371!3d46.051148848694524!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47652d63b27f653d%3A0xd814b742356d4593!2sTromostovje%2C+Stritarjeva+ulica%2C+1000+Ljubljana!5e0!3m2!1ssl!2ssi!4v1494754048011" width="100%" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>',
        ]);

        $translationPage = Page::find(9);
        $translationPage->saveTranslation('sl', [
            'title' => 'Pišite nam',
            'lead'  => 'Izpolnite obrazec in nas kontaktirajte še danes.',
            'body'  => null,
        ]);

        $translationPage = Page::find(10);
        $translationPage->saveTranslation('sl', [
            'title' => 'Blog',
            'lead'  => null,
            'body'  => null,
        ]);
    }
}
