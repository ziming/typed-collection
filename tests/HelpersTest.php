<?php

namespace Gamez\Illuminate\Support\Tests;

use DateTime;
use DateTimeInterface;
use Gamez\Illuminate\Support\TypedCollection;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class HelpersTest extends TestCase
{
    #[Test]
    public function it_cannot_be_created_with_an_unsupported_type_of_item(): void
    {
        $this->expectException(InvalidArgumentException::class);
        typedCollect([new Item(), 'string', new Item()], Item::class);
    }

    #[Test]
    public function it_can_be_created_with_supported_types(): void
    {
        $typedCollection = typedCollect([new Item(), new Item()], Item::class);
        $this->assertInstanceOf(TypedCollection::class, $typedCollection);
    }

    #[Test]
    public function it_can_accept_an_array_of_types(): void
    {
        $typedCollection = typedCollect([new DateTime(), new Item()], [DateTimeInterface::class, Item::class]);
        $this->assertInstanceOf(TypedCollection::class, $typedCollection);
    }
}
