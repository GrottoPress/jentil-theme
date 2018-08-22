<?php
declare (strict_types = 1);

namespace Jentil\Theme\Setups\Customizer\SamplePanel;

final class SampleSection extends AbstractSection
{
    public function __construct(SamplePanel $sample_panel)
    {
        parent::__construct($sample_panel);

        $this->id = 'sample_section';

        $this->args['title'] = \esc_html__('Sample Section', 'jentil-theme');
        $this->args['active_callback'] = function (): bool {
            return $this->customizer->app->utilities->sample->where();
        };
    }

    protected function setSettings()
    {
        parent::setSettings();

        unset(
            $this->settings['Text'],
            $this->controls['Text']
        );
    }
}
