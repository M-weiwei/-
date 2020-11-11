<?php
//引入配置文件
include "dbModel.class.php";
class Model extends DBModel
{
    protected $tableName = ""; //存储表名
    protected $sql = ""; //存储最后执行的SQL语句
    protected $limit = ""; //存储limit条件
    protected $order = ""; //存储order排序条件
    protected $field = "*"; //存储要查询的字段
    protected $where = ""; //存储where条件
    protected $allFields = []; //存储当前表的所有字段
    /**
     * 构造方法 初始化
     * @param string $tableName 要操作的表名
     */
    public function __construct($tableName)
    {
        //连接数据库
        parent::__construct();
        //存储表名
        $this->tableName = $tableName;
        //获取当前数据表中有哪些字段
        $this->getFields();
    }
    public function setwhere($where)
    {
        $this->where = "where " . $where;
        return $this;
    }
    public function setTableName($tableName)
    {
        //存储表名
        $this->tableName = $tableName;
        //获取当前数据表中有哪些字段
        $this->getFields();
    }
    /**
     * 获取当前表的所有字段
     * @return array 成功则返回一维数组字段
     */
    public function getFields()
    {
        //查看当前表结构
        $sql = "desc {$this->tableName}";
        $res = parent::query($sql);
        //var_dump($res);
        if ($res) {
            $arr = [];
            $flag = 0;
            while ($row = mysqli_fetch_array($res)) {
                $arr[$flag] = $row["Field"];
                $flag += 1;
            }
            //var_dump($arr);
            //从二维数组中取出指定下标的列
            $this->allFields = $arr;
            return $this->allFields;
        } else {
            die("表名错误");
        }
    }
    /**
     * 添加操作
     * @param array $data 要添加的数组
     * @return int 返回受影响行数
     */
    public function add($data)
    {
        //判断是否是数组
        if (!is_array($data)) {
            return $this;
        }
        //过滤非法字段
        // foreach($data as $k => $v){
        //     if (!in_array($k,$this->allFields)) {
        //         unset($data[$k]);
        //     }
        // }
        //将数组中的键取出
        $keys = array_keys($data);
        //将数组中取出的键转为字符串拼接
        $key = implode(",", $keys);
        //将数组中的值转化为字符串拼接
        $value = implode("','", $data);
        //准备SQL语句
        $sql = "insert into {$this->tableName} ({$key}) values('{$value}')";
        $this->sql = $sql;
        // echo $sql;
        //执行并发送SQL，返回受影响行数
        return parent::fExec($sql);
    }
    /**
     * 删除操作
     * @param string $id 要删除的id
     * @return int 返回受影响行数
     */
    public function deletesql($id = "")
    {
        //判断id是否存在
        if (empty($id)) {
            $where = $this->where;
        } else {
            $where = "where id={$id}";
        }
        $sql = "delete from {$this->tableName} {$where}";
        $this->sql = $sql;
        //执行并发送SQL,返回受影响行数
        return (int)parent::fExec($sql);
    }
    /**
     * 修改操作
     * @param array $data 要修改的数组
     * @return int 返回受影响行数
     */
    public function update($data)
    {
        // //判断是否是数组
        // if (!is_array($data)){
        //   return $this;
        // }
        // //判断是否全是非法字段
        // if (empty($data)) {
        //   die('全是非法字段');
        // }
        $str = "";
        //过滤非法字段
        // print_r($data);
        // print_r($this->allFields);
        foreach ($data as $k => $v) {
            //过滤后再拼接成set字段
            if (in_array($k, $this->allFields)) {
                $str .= "{$k}='{$v}',";
            } else {
                unset($data[$k]);
            }
        }
        // echo $str;
        //判断是否传了条件
        if ($this->where == null) {
            die('请传入修改条件');
        }
        //去除右边的,
        $str = rtrim($str, ',');
        $sql = "update {$this->tableName} set {$str} {$this->where}";
        // echo $sql;
        // $this->sql = $sql;
        return (int)parent::fExec($sql);
    }
    /**
     * 查询多条数据
     * @return array 成功返回二维数组，失败返回空数组
     */
    public function select()
    {
        $sql = "select {$this->field} from {$this->tableName} {$this->where} {$this->order} {$this->limit}";
        $this->sql = $sql;
        //执行SQL,结果集是一个对象
        $res = parent::query($sql);
        //判断是否查询成功,
        if ($res) {
            //成功返回二维数组
            $resarr = [];
            $fieldcon = explode(",", $this->field);
            if ($fieldcon = "*") {
                $fieldcon = $this->allFields;
            }
            $flag1 = 0;
            while ($row = mysqli_fetch_array($res)) {
                $flag = 0;
                $arr = [];
                foreach ($fieldcon as $key) {
                    $arr[$key] = $row[$flag];
                    $flag += 1;
                }
                $resarr[$flag1] = $arr;
                $flag1 += 1;
            }
            return $resarr;
        }
        // echo $sql;
        //失败返回空数组
        return [];
    }
    /**
     * 查询一条数组
     * @param string $id 要查询的id
     * @return array 返回一条数据
     */
    public function find($id = "")
    {
        //判断是否存在id
        if (empty($id)) {
            $where = $this->where;
        } else {
            $where = "where id={$id}";
        }
        $sql = "select {$this->field} from {$this->tableName} {$where} {$this->order} limit 1";
        $this->sql = $sql;
        //执行sql,结果集为对象
        $res = parent::query($sql);
        //判断是否查询成功
        if ($res) {
            //成功则返回一条数据(一维数组)
            $result = parent::row($res);
            return $result;
        }
        //失败返回空数组
        return [];
    }
    /**
     * 统计总数目
     * @return int 返回总数
     */
    public function countsql()
    {
        $sql = "select count(*) as total from {$this->tableName} {$this->where} limit 1";
        $this->sql = $sql;
        //执行SQL,结果集为对象
        $res = parent::query($sql);
        //处理结果集
        if ($res) {
            while ($row = mysqli_fetch_array($res)) {
                $result = $row["total"];
            }
            //var_dump($result);
            return $result;
        }
        return 0;
    }
    /**
     * 设置要查询的字段信息
     * @param string $field 要查询的字段
     * @return object 返回自己，保证连贯操作
     */
    public function field($field)
    {
        //判断字段是否存在
        if (empty($filed)) {
            return $this;
        }
        $this->field = $field;
        return $this;
    }
    /**
     * 获取最后执行的sql语句
     * @return string sql语句
     */
    public function _sql()
    {
        return $this->sql;
    }
    /**
     * where条件
     * @param string $where 要输入的where条件
     * @return object 返回自己，保证连贯操作
     */
    public function where($where)
    {
        $this->where = "where " . $where;
        return $this;
    }
    /**
     * order条件
     * @param string $order 要输入的order条件
     * @return object 返回自己，保证连贯操作
     */
    public function order($order)
    {
        $this->order = "order by " . $order;
        return $this;
    }
    /**
     * limit条件
     * @param string $limit 要输入的limit条件
     * @return object 返回自己，保证连贯操作
     */
    public function limit($limit)
    {
        $this->limit = "limit " . $limit;
        return $this;
    }
}
