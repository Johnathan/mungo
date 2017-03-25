<?php namespace App\Http\Controllers\Api;

use Fractal;
use Illuminate\Support\Facades\Input;
use Response;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use League\Fractal\TransformerAbstract;
use Spatie\Fractalistic\ArraySerializer;

class Controller extends \App\Http\Controllers\Controller
{
    protected $status = 200;
    protected $transformer;
    protected $responseData;

    /**
     * @param int $status
     * @return $this
     */
    public function setStatus(int $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @param TransformerAbstract $transformer
     * @return $this
     */
    public function setTransformer(TransformerAbstract $transformer)
    {
        $this->transformer = $transformer;

        return $this;
    }

    /**
     * @param $responseData
     * @return $this
     * @throws \Exception
     */
    public function setResponseData($responseData)
    {
        if (is_a($responseData, Model::class)) {
            $this->responseData = Fractal::item($responseData);
        }
        if (is_a($responseData, Collection::class)) {
            $this->responseData = Fractal::collection($responseData);
        }

        // If $this->responseData ins't set it's because we didn't get a Model or Collection
        if (! $this->responseData) {
            throw new \Exception('Must pass an instance of ' . Model::class . ' or ' . Collection::class);
        }

        if (Input::has('include')) {
            $this->responseData->parseIncludes(Input::get('include'));
        }

        return $this;
    }

    /**
     * @return array
     */
    public function transform()
    {
        return $this->responseData
            ->transformWith($this->transformer)
            ->serializeWith( new ArraySerializer )
            ->toArray();
    }

    /**
     * @param Collection $collection
     * @param TransformerAbstract $transformer
     * @return mixed
     */
    public function respondWithCollection(Collection $collection, TransformerAbstract $transformer)
    {
        $response = $this->setTransformer($transformer)
            ->setResponseData($collection)
            ->transform();

        return $this->respond($response);
    }

    /**
     * @param Model $item
     * @param TransformerAbstract $transformer
     * @return mixed
     */
    public function respondWithItem(Model $item, TransformerAbstract $transformer)
    {
        $response = $this->setTransformer($transformer)
            ->setResponseData($item)
            ->transform();

        return $this->respond($response);
    }

    /**
     * @param array $responseData
     * @return mixed
     */
    public function respond(array $responseData)
    {
        return Response::json($responseData, $this->status);
    }
}
