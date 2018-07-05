<?php

namespace app\models\v1\swagger;

/**
 * @SWG\Definition(
 *      definition="Error",
 *      required={"code", "msg", "data"},
 *      @SWG\Property(
 *          property="code",
 *          type="integer",
 *          format="int32",
 *          example=0
 *      ),
 *      @SWG\Property(
 *          property="msg",
 *          type="string",
 *          example="You are requesting with an invalid credential."
 *      ),
 *      @SWG\Property(
 *          property="data",
 *          type="array",
 *          @SWG\Items(
 *          ),
 *      ),
 * )
 */

/**
 * @SWG\Definition(
 *      definition="Car",
 *      required={"id", "name", "image", "voice_type", "sort"},
 * 	    @SWG\Property(property="id", type="integer", example=1, description="车型ID"),
 * 		@SWG\Property(property="name", type="string", description="车型名称"),
 * 		@SWG\Property(property="image", type="string", description="车型图片"),
 * 		@SWG\Property(property="voice_type", type="integer", description="音箱类型 0-普通音箱 1-BOSE音箱"),
 * 		@SWG\Property(property="sort", type="integer", description="显示排序,值越小越靠前")
 * )
 */

 /**
 * @SWG\Definition(required={"id"}, @SWG\Xml(name="Id"))
 */
class Id
{
    /**
     * 用户ID
     *
     * @SWG\Property(example = 10000)
     *
     * @var integer
     */
    public $id;
}

/**
 * @SWG\Definition(required={"access_token", "username"}, @SWG\Xml(name="UserIdList"))
 */
class UserIdList
{
    /**
     * Access Token
     *
     * @SWG\Property()
     *
     * @var string
     */
    public $access_token;
    /**
     * @SWG\Property()
     *
     * @var Id[]
     */
    public $idList;
}