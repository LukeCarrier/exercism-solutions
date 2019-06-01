use std::fmt;

const HOURS_IN_DAY: i32 = 24;
const MINUTES_IN_HOUR: i32 = 60;

#[derive(Debug, Clone, Copy, PartialEq)]
pub struct Clock {
    pub hours: i32,
    pub minutes: i32,
}

impl Clock {
    pub fn new(hours: i32, minutes: i32) -> Self {
        let mut hours = hours;
        let mut minutes = minutes;

        if minutes < 0 {
            hours += (minutes - MINUTES_IN_HOUR) / MINUTES_IN_HOUR;
            minutes = minutes % MINUTES_IN_HOUR + MINUTES_IN_HOUR;
        }
        if hours < 0 {
            hours = hours % HOURS_IN_DAY + HOURS_IN_DAY;
        }

        Self {
            hours: (hours + minutes / MINUTES_IN_HOUR) % HOURS_IN_DAY,
            minutes: minutes % MINUTES_IN_HOUR,
        }
    }

    pub fn add_minutes(&self, minutes: i32) -> Self {
        Self::new(self.hours, self.minutes + minutes)
    }
}

impl fmt::Display for Clock {
    fn fmt(&self, f: &mut fmt::Formatter) -> fmt::Result {
        write!(f, "{:02}:{:02}", self.hours, self.minutes)
    }
}
