<?php
/**
 * @link http://encomage.com
 * @mail hello@encomage.com
 */
namespace Encomage\Emailblocker\Model;

use Magento\Framework\Mail\MessageInterface;

/**
 * Class Transport
 * @package Encomage\Emailblocker\Model
 */
class Transport extends \Magento\Framework\Mail\Transport
{
    /** @var  \Encomage\Emailblocker\Helper\Data */
    protected $helper;

    /**
     * @param MessageInterface $message
     * @param \Encomage\Emailblocker\Helper\Data $helper
     * @param string|array $parameters
     */
    public function __construct(
        \Magento\Framework\Mail\MessageInterface $message,
        \Encomage\Emailblocker\Helper\Data $helper,
        $parameters = null
    ) {
        $this->helper = $helper;
        parent::__construct($message, $parameters);
    }

    /**
     * Send a mail using this transport
     *
     * @return void
     * @throws \Magento\Framework\Exception\MailException
     */
    public function sendMessage()
    {
        $recipients = $this->_message->getRecipients();
        if ($this->helper->emailBlockerIsEnabled() && empty($recipients)) {
            return;
        }
        parent::sendMessage();
    }
}
