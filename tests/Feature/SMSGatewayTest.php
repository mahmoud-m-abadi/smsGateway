<?php

namespace Tests\Feature;

use App\Events\SMSGateway\SMSSentEvent;
use App\Listeners\SMSGatewayListener;
use App\Models\SMSGatewayResult;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class SMSGatewayTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private string $to = '09194747602';

    public function test_system_can_get_sms_result_list_successfully()
    {
        SMSGatewayResult::factory(15)->create();

        $this->getJson(route('sms.list'))
            ->assertJsonCount(15, 'data');
    }

    public function test_system_can_send_sms_successfully()
    {
        $this->postJson(route('sms.send'), $this->correctSMSData())
            ->assertNoContent();
    }

    /**
     * @dataProvider invalidSendSMSData
     */
    public function test_system_can_not_send_sms($invalidData)
    {
        [$rule, $payload] = $invalidData();

        $this->postJson(route('sms.send'), $payload)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_system_can_run_sms_sent_event()
    {
        Event::fake([
            SMSSentEvent::class
        ]);

        $this->postJson(route('sms.send'), $this->correctSMSData());

        Event::assertDispatched(SMSSentEvent::class);
        Event::subscribe(SMSGatewayListener::class);
    }

    /**
     * @return \Closure[][]
     */
    public function invalidSendSMSData()
    {
        return [
            'It fails when TO field is empty' => [
                function () {
                    return [
                        'to',
                        array_merge($this->correctSMSData(), ['to' => null])
                    ];
                }
            ],
            'It fails when MESSAGE field is empty' => [
                function () {
                    return [
                        'message',
                        array_merge($this->correctSMSData(), ['message' => null])
                    ];
                }
            ],
            'It fails when TO field is invalid' => [
                function () {
                    return [
                        'to',
                        array_merge($this->correctSMSData(), ['to' => "12345"])
                    ];
                }
            ],
            'It fails when MESSAGE field is less than 2 characters' => [
                function () {
                    return [
                        'message',
                        array_merge($this->correctSMSData(), ['message' => 't'])
                    ];
                }
            ],
            'It fails when MESSAGE field is more than 55 characters' => [
                function () {
                    return [
                        'message',
                        array_merge($this->correctSMSData(), ['message' =>
                            'free from error; in accordance with fact or truth.
                            make sure you have been given the correct information'
                        ])
                    ];
                }
            ],
        ];
    }

    /**
     * @return array
     */
    private function correctSMSData(): array
    {
        return [
            'to' => $this->to,
            'message' => 'This is a test message'
        ];
    }
}
