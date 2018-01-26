<?php
/**
 * Created by PhpStorm.
 * User: marc.wilhelm
 * Date: 16.01.2018
 * Time: 08:50
 */

namespace App\Mapper;


use DOMDocument;
use DOMXPath;

class ZInvoiceMapper extends AbstractMapper
{
    public function getXmlData()
    {
        $doc = new DOMDocument();
        $doc->load(__DIR__ . '/../../resources/files/z-invoice.xml');
        $xpath = new DOMXPath($doc);
        $xpath->registerNameSpace('ns', 'http://tempuri.org/invoice_batch_generic.xsd');

        $root = $xpath->query('/ns:invoice_batch_generic/ns:account/ns:invoice');

        $elements = [];
        foreach ($root as $invoice) {
            $invoiceNumber = $xpath->query('ns:invoice_number', $invoice)->item(0)->nodeValue;
            $elements[$invoiceNumber]['invoice_number'] = $invoiceNumber;
            $elements[$invoiceNumber]['invoice_total'] = $xpath->query('ns:invoice_total',
                $invoice)->item(0)->nodeValue;
            $elements[$invoiceNumber]['total_tax_value'] = $xpath->query('ns:total_tax_value',
                $invoice)->item(0)->nodeValue;
            $invoiceItems = $xpath->query('ns:invoice_item', $invoice);
            foreach ($invoiceItems as $item) {
                $elements[$invoiceNumber]['items'][] = [
                    'invoice_id' => $xpath->query("ns:invoice_id ", $item)->item(0)->nodeValue,
                    'invoice_item_id' => $xpath->query("ns:invoice_item_id", $item)->item(0)->nodeValue,
                    'service_name' => $xpath->query("ns:service_name", $item)->item(0)->nodeValue,
                    'service_units' => $xpath->query("ns:service_units", $item)->item(0)->nodeValue,
                    'service_extended_price' => $xpath->query("ns:service_extended_price", $item)->item(0)->nodeValue,
                ];
            }
        }
        return $elements;
    }
}
