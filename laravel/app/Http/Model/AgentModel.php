<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-11-28
 * Time: 22:09
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class AgentModel extends Model
{
    protected $table = 'agents';
    const UPDATED_AT = 'last_modify';
    const CREATED_AT = 'create_time';
    protected $primaryKey = 'agent_id';

}