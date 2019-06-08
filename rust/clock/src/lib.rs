use std::fmt;

const HOURS_IN_DAY: i32 = 24;
const MINUTES_IN_HOUR: i32 = 60;
const MINUTES_IN_DAY: i32 = HOURS_IN_DAY * MINUTES_IN_HOUR;

#[derive(Debug, Clone, Copy, PartialEq)]
pub struct Clock {
    pub total_minutes: u32,
}

impl Clock {
    pub fn new(hours: i32, minutes: i32) -> Self {
        let mut total_minutes = hours * 60 + minutes;
        if total_minutes < 0 {
            total_minutes = total_minutes % MINUTES_IN_DAY + MINUTES_IN_DAY;
        }
        total_minutes = total_minutes % MINUTES_IN_DAY;

        Self { total_minutes: total_minutes as u32 }
    }

    pub fn add_minutes(&self, minutes: i32) -> Self {
        Self::new(0, self.total_minutes as i32 + minutes)
    }
}

impl fmt::Display for Clock {
    fn fmt(&self, f: &mut fmt::Formatter) -> fmt::Result {
        let hours = self.total_minutes as i32 / MINUTES_IN_HOUR;
        let minutes = self.total_minutes as i32 % MINUTES_IN_HOUR;
        write!(f, "{:02}:{:02}", hours, minutes)
    }
}
