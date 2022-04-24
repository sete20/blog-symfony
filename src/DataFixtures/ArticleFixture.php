<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use Assert\DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArticleFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        for($i=0; $i < 5;$i++){
            $category =new  Category();
            $category->setName('اسم المجال ' . $i);
            $category->setDescription('وصف المجال' . $i);
            $manager->persist($category);
            for($l=0;$l < 5; $l++){
                $article = new Article();
                $article->setTitle("اللقب " .$l);
                $article->  setContent("
                    ذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.
				إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.
				ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملاً،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.
               " .$l);
               $article->setCategory($category);
            //    $article->setCreatedAt(new \DateTime());
               $article->setImage('https://picsum.photos/seed/picsum/300/150');
                $manager->persist($article);
            }

        }
        $manager->flush();
    }
}
