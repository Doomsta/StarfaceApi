<?php

namespace Starface\Api;


use Starface\Response\CallState;

class CallRequests extends Api
{
    const METHOD_GET_CALL_IDS = 'ucp.v22.requests.call.getCallIds';
    const METHOD_GET_CALL_STATE = 'ucp.v22.requests.call.getCallState';
    const METHOD_PLACE_CALL_WITH_PHONE = 'ucp.v22.requests.call.placeCallWithPhone';
    const METHOD_HANG_UP_CALL = 'ucp.v22.requests.call.hangupCall';


    /**
     * @return string[]
     */
    public function getCallIds()
    {
        return $this->rpcCall(self::METHOD_GET_CALL_IDS);
    }

    /**
     * @TODO
     * @param $callId
     * @return CallState
     */
    public function getCallState($callId)
    {
        $d = $this->rpcCall(self::METHOD_GET_CALL_STATE, array($callId), true);
        return new CallState();
    }

    /**
     * @param $destinationNumber
     * @param null $phoneId
     * @param null $callId
     * @return mixed
     */
    public function placeCall($destinationNumber, $phoneId = null, $callId = null)
    {
        return $this->rpcCall(
            self::METHOD_PLACE_CALL_WITH_PHONE,
            [$destinationNumber, $phoneId, $callId]
        );
    }

    /**
     * @param $callId
     * @return mixed|null|string
     */
    public function hangupCall($callId)
    {
        return $this->rpcCall(self::METHOD_HANG_UP_CALL, [$callId]);
    }

} 