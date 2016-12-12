<?php
/**
 *@auth demon 2016-10-11
 *非对称加解密: 根据需要传入公钥或私钥、要加密或解密的内容创建SshRsa对象，通过调用对应的方法获取结果,比如公钥加密 $SshRsa->publicKeyEncrypt()
 **/
class SshRsa{
    private $publicKey;//公钥
    private $privateKey;//私钥

    private $publicCountKey;//算法用到的公钥
    private $privateCountKey;//算法用到的私钥

    private $content;//要加密或解密的内容

    private $publicEncryptContent;//公钥加密结果
    private $publicDecryptContent;//公钥解密结果
    private $privateEncryptContent;//私钥加密结果
    private $privateDecryptContent;//私钥解密结果

    /**
     *@param array $config 传入加解密的钥匙和内容, 如需要公钥加密 $confg = [ 'publicKey' => $publicKey, 'content' => $content ], 公私钥为文件，请通过file_get_contents函数获取内容;
     **/
    public function __construct($config){
        $keys = ['publicKey', 'privateKey', 'content'];

        if( !isset($config['content']) ){
            die('请输入要处理的内容');
        }

        foreach( $keys as $key ){
            if( isset($config[$key]) ){
                $this->$key = $config[$key];
            }
        }

        if( $this->publicKey ){
            $this->publicCountKey = openssl_pkey_get_public($this->publicKey);
        }
        if( $this->privateKey ){
            $this->privateCountKey = openssl_pkey_get_private($this->privateKey);
        }
    }

    //公钥加密
    public function publicKeyEncrypt(){

        if( !$this->publicEncryptContent ){
            //公钥
            if( empty($this->publicCountKey) ){
                die('公钥不能为空');
            }

            openssl_public_encrypt($this->content, $this->publicEncryptContent, $this->publicCountKey);
        }

        return $this->publicEncryptContent;
    }

    //公钥解密
    public function publicKeyDecrypt(){

        if( !$this->publicDecryptContent ){
            //公钥
            if( empty($this->publicCountKey) ){
                die('公钥不能为空');
            }

            openssl_public_decrypt($this->content, $this->publicDecryptContent, $this->publicCountKey);
        }

        return $this->publicDecryptContent;
    }

    //私钥加密
    public function privateKeyEncrypt(){

        if( !$this->privateEncryptContent ){
            //公钥
            if( empty($this->privateCountKey) ){
                die('私钥不能为空');
            }

            openssl_private_encrypt($this->content, $this->privateEncryptContent, $this->privateCountKey);
        }

        return $this->privateEncryptContent;
    }

    //私钥解密
    public function privateKeyDecrypt(){

        if( !$this->privateDecryptContent ){
            //公钥
            if( empty($this->privateCountKey) ){
                die('私钥不能为空');
            }

            openssl_private_decrypt($this->content, $this->privateDecryptContent, $this->privateCountKey);
        }

        return $this->privateDecryptContent;
    }
}
