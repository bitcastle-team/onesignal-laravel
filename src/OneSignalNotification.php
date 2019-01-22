<?php

namespace Bitcastle\OneSignal;

class OneSignalNotification
{
    const ALL_SEGMENTS = 'All';

    private $options = ['app_id' => '',
                        'included_segments' => [self::ALL_SEGMENTS]];

    /**
     * Class builder method, in it you can create a notification by passing only one message.
     *
     * @param string $message
     * @param string $title
     * @param string $locale @see https://documentation.onesignal.com/docs/language-localization#section-supported-languages
     */
    public function __construct(string $message = '', string $title = '')
    {

        // check if function extists prevent errors on testing the service (tests/test.php)
        if(function_exists("config")) {
            $title = '' ? config('app.title') : $title;
        }


        /**
         * It is mandatory to have a message in the EN language
         */
        $this->addMessage("en", $title, $message);
    }

    /**
     * Method to access the options as if they were properties.
     *
     * @param string $property
     * @return mixed
     */
    public function __get(string $property)
    {

        if (isset($this->options[$property])) {
            return is_array($this->options[$property]) ? collect($this->options[$property]) : $this->options[$property];
        }

        $snakeProperty = snake_case($property);

        if (isset($this->options[$snakeProperty])) {
            return is_array($this->options[$snakeProperty]) ? collect($this->options[$snakeProperty]) : $this->options[$snakeProperty];
        }

        throw new \LogicException("Property {$property} doesn't exists in OneSignalNotification.");
    }

    /**
     * Add a message in a specific language
     *
     * @param string $locale
     * @param string $title
     * @param string $message
     * @return OneSignalNotification
     */
    public function addMessage(string $locale, string $title, string $message) : OneSignalNotification
    {
        $this->options['headings'][$locale] = $title;
        $this->options['contents'][$locale] = $message;
        return $this;
    }

    /**
     * Sets the notification with the information passed in the parameter.
     *
     * @param array $options
     * @return OneSignalNotification
     */
    public function setNotification(array $options) : OneSignalNotification
    {
        $this->options = $options;
        return $this;
    }

    /**
     * Add any option for sending the notification.
     *
     * @param string $key
     * @param mixed $value
     * @return OneSignalNotification
     */
    public function addOption(string $key, $value) : OneSignalNotification
    {
        $this->options[$key] = $value;
        return $this;
    }

    /**
     * Remove any option for sending the notification.
     *
     * @param string $key
     * @return OneSignalNotification
     */
    public function removeOption(string $key) : OneSignalNotification
    {
        unset($this->options[$key]);
        return $this;
    }

    /**
     * Set app_id index into options property
     *
     * @param string $key
     * @return OneSignalNotification
     */
    public function setAppId($appKey){
        $this->options["app_id"] = $appKey;
        return $this;
    }

    /**
     * Converting the object to an array element
     *
     * @return array
     */
    public function toArray() : array
    {
        return $this->options;
    }
}
