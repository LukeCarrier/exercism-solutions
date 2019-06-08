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
        let mut total_minutes = hours * 60 + minutes;
        if total_minutes < 0 {
            total_minutes =
                    total_minutes % (HOURS_IN_DAY * MINUTES_IN_HOUR)
                    + (HOURS_IN_DAY * MINUTES_IN_HOUR);
        }

        Self {
            hours: (total_minutes / MINUTES_IN_HOUR) % HOURS_IN_DAY,
            minutes: total_minutes % MINUTES_IN_HOUR,
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
