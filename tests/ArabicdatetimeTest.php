<?php

namespace Maherelgamil\Arabicdatetime\Tests;

use Maherelgamil\Arabicdatetime\Arabicdatetime;

class ArabicdatetimeTest extends TestCase
{
    protected $arabDateTime;

    public function setUp()
    {
        parent::setUp();

        $this->arabDateTime = new Arabicdatetime();
    }

    public function testGregorianDateWithEnglsihNumbers()
    {
        $this->assertSame('arabicdatetime::days.tue 09 / arabicdatetime::months.dec 12 / 2014', $this->arabDateTime->date(1418123530, 0));
    }

    public function testHijriDateWithIndianNumbers()
    {
        $this->assertSame('١٦ / ٢ / ٣٦ ', $this->arabDateTime->date(1418123530, 1, 'd / m / y ', 'indian'));
    }

    public function testGetDays()
    {
        $expected = [
            'arabicdatetime::days.sat',
            'arabicdatetime::days.sun',
            'arabicdatetime::days.mon',
            'arabicdatetime::days.tue',
            'arabicdatetime::days.wed',
            'arabicdatetime::days.thu',
            'arabicdatetime::days.fri',
        ];

        $this->assertSame($expected, $this->arabDateTime->getDays());
    }

    public function testGetArabicDays()
    {
        if (version_compare(PHP_VERSION, '5.6', '<')) {
            $this->markTestSkipped('Trans will not be worked on PHP 5.4!');
        }

        $expected = [
            'السبت',
            'الأحد',
            'الإثنين',
            'الثلاثاء',
            'الأربعاء',
            'الخميس',
            'الجمعة',
        ];

        $this->assertSame($expected, $this->arabDateTime->getArabicDays());
    }

    public function testGetMonths()
    {
        $expected = [
            'arabicdatetime::months.jan',
            'arabicdatetime::months.feb',
            'arabicdatetime::months.mar',
            'arabicdatetime::months.apr',
            'arabicdatetime::months.may',
            'arabicdatetime::months.jun',
            'arabicdatetime::months.jul',
            'arabicdatetime::months.aug',
            'arabicdatetime::months.sep',
            'arabicdatetime::months.nov',
            'arabicdatetime::months.dec',
        ];

        $this->assertSame($expected, $this->arabDateTime->getMonths());
    }

    public function testGetArabicMonths()
    {
        if (version_compare(PHP_VERSION, '5.6', '<')) {
            $this->markTestSkipped('Trans will not be worked on PHP 5.4!');
        }

        $expected = [
            'يناير',
            'فبراير',
            'مارس',
            'أبريل',
            'مايو',
            'يونيو',
            'يوليو',
            'أغسطس',
            'سبتمبر',
            'نوفمبر',
            'ديسمبر',
        ];

        $this->assertSame($expected, $this->arabDateTime->getArabicMonths());
    }

    public function testGetHijriMonths()
    {
        $expected = [
            'arabicdatetime::hijri_months.muharram',
            'arabicdatetime::hijri_months.safar',
            'arabicdatetime::hijri_months.rabi_al_awwal',
            'arabicdatetime::hijri_months.rabi_al_akhir',
            'arabicdatetime::hijri_months.jamadi_al_awwal',
            'arabicdatetime::hijri_months.jamadi_al_akhir',
            'arabicdatetime::hijri_months.rajab',
            'arabicdatetime::hijri_months.shabaan',
            'arabicdatetime::hijri_months.ramadhan',
            'arabicdatetime::hijri_months.shawwal',
            'arabicdatetime::hijri_months.zilqad',
            'arabicdatetime::hijri_months.zilhajj',
        ];

        $this->assertSame($expected, $this->arabDateTime->getHijriMonths());
    }

    public function testGetArabicHijriMonths()
    {
        if (version_compare(PHP_VERSION, '5.6', '<')) {
            $this->markTestSkipped('Trans will not be worked on PHP 5.4!');
        }

        $expected = [
            'محرم',
            'صفر',
            'ربيع أول',
            'ربيع ثاني',
            'جمادى أول',
            'جمادى ثاني',
            'رجب',
            'شعبان',
            'رمضان',
            'شوال',
            'ذو القعدة',
            'ذو الحجة',
        ];

        $this->assertSame($expected, $this->arabDateTime->getArabicHijriMonths());
    }

    public function testRemainingTime()
    {
        $this->assertStringStartsWith('arabicdatetime::', $this->arabDateTime->remainingTime(1418123530));
    }

    public function testLeftTime()
    {
        $this->assertStringStartsWith('arabicdatetime::', $this->arabDateTime->leftTime(1418123530));
    }

    public function testLeftRemainingTime()
    {
        $this->assertStringStartsWith('arabicdatetime::', $this->arabDateTime->leftRemainingTime(1418123530));
    }

    public function testGetDateWithInvalidMode()
    {
        $expected = 'Undefined MOD !!';

        $this->assertSame($expected, $this->arabDateTime->date(1418123530, -1, 'd / m / y ', 'indian'));
    }
}
