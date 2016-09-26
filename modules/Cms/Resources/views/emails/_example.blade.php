<?php

$style = [
    'header-3' => 'margin-top: 0; color: #2F3133; font-size: 17px; font-weight: bold; text-align: left;',
    'paragraph' => 'margin-top: 0; color: #74787E; font-size: 16px; line-height: 1.5em; text-align: left;',
    'paragraph-sub' => 'margin-top: 0; color: #74787E; font-size: 12px; line-height: 1.5em;',
    'paragraph-center' => 'text-align: center;',
    'ul-list' => 'text-align: left; color: #74787E; font-size: 16px; line-height: 1.5em;',
    'li-list' => 'list-style: circle; text-align: left; margin: 0; padding: 0 0 10px 0;',
];

?>

@extends('theme::emails.partials.new-layout', [
    'action' => [
        'title' => 'Visit our website!',
        'url' => 'http://www.numencode.com',
        'color' => 'green',
    ],
])

@section('title')
    We want to earn your deepest trust!
@stop

@section('intro')
    I want the name "Doe Product" to be synonymous in your mind with quality. More than synonymous--I want them to be one and the same. In fact, when you think "quality," "reliability," "versatility," or "power," I want you to think "Doe Product."
@stop

@section('content')
    <p style="{{ $style['paragraph'] }}">We are a leader. We work with leaders. And our long history of innovation and support keep you ahead of the curve on (list two primary product attributes). But we want you to think of our customer service on the same level as our technology.</p>
    <p style="{{ $style['paragraph'] }}">It is my pleasure to introduce the new version of "Doe Product." It's focused on the customer, listening to his or her issues and challenges, and finally meeting those challenges with products, services, and resources unmatched in quality and functionality.</p>
    <h3 style="{{ $style['header-3'] }}">The NEW Doe Product is the most powerful we have ever built.</h3>
    <ul style="{{ $style['ul-list'] }}">
        <li style="{{ $style['li-list'] }}">price / performance</li>
        <li style="{{ $style['li-list'] }}">easy to use</li>
        <li style="{{ $style['li-list'] }}">best product on the market</li>
    </ul>
    <p style="{{ $style['paragraph'] }}">And that's just the beginning. Take a moment to discover the new Doe Product. And then visit our new website to see how we've changed. We are committed to your satisfaction and welcome your feedback. We'll do all we can to make your Doe Product experience positive.</p>
@stop

@section('outro')
    As always, thank you for choosing Doe.
@stop
